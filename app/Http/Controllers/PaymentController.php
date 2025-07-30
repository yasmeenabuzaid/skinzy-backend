<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Square\SquareClient;
use Square\Payments\Requests\CreatePaymentRequest;
use Square\Types\Money;
use Square\Types\Currency;
use App\Models\PaymentProof;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index()
    {

        $proofs = PaymentProof::with(['user', 'order'])->latest()->get();
        return view('dashboard.payment.index', ['proofs' => $proofs]);
    }

  public function review(Request $request, PaymentProof $payment_proof)
{
    $oldStatus = $payment_proof->status;
    $newStatus = $request->status;
    $reviewedAt = now();

    $payment_proof->update([
        'status' => $newStatus,
        'note' => $request->note,
        'details' => "Status changed from '{$oldStatus}' to '{$newStatus}' on {$reviewedAt->format('Y-m-d H:i:s')} by user ID " . auth()->id(),
        'paid_at' => $reviewedAt,
        'reviewed_by' => auth()->id(),
        'reviewed_at' => $reviewedAt,
    ]);

    return redirect()->back()->with('success', 'تم تحديث الحالة.');
}


    public function success($id)
    {
        return view('components.user_side.payment.payment-success', [
            'payment_id' => $id,
        ]);
    }

    public function failed($id)
    {
        return view('components.user_side.payment.payment.failed', [
            'payment_id' => $id,
        ]);
    }

    public function processPayment(Request $request)
    {
        Log::info('Starting payment processing', $request->all());

        // التحقق من صحة المدخلات
        $request->validate([
            'nonce' => 'required|string',
            'order_id' => 'required|integer|exists:orders,id',
            'amount' => 'required|numeric|min:0.01', // تأكد من أن المبلغ صحيح
        ]);

        // التحقق إذا كانت قيمة المبلغ صحيحة
        $amount = $request->input('amount');
        if ($amount <= 0) {
            return redirect()->route('home')->with('error', 'The payment amount must be greater than zero.');
        }

        $baseUrl = config('services.square.env') === 'production'
            ? 'https://connect.squareup.com'
            : 'https://connect.squareupsandbox.com';

        Log::info("Square environment: $baseUrl");

        $client = new SquareClient(
            config('services.square.access_token'),
            null,
            ['baseUrl' => $baseUrl]
        );

        $nonce = $request->input('nonce');
        $idempotencyKey = Str::uuid()->toString();
        $amountCents = round($amount * 100);

        Log::info("Payment data: nonce=$nonce, amountCents=$amountCents, idempotencyKey=$idempotencyKey");

        $amountMoney = new Money([
            'amount' => $amountCents,
            'currency' => Currency::Usd->value,
        ]);

        $paymentRequest = new CreatePaymentRequest([
            'sourceId' => $nonce,
            'idempotencyKey' => $idempotencyKey,
            'amountMoney' => $amountMoney,
        ]);

        $orderId = $request->input('order_id');

        try {
            // محاولة إرسال الطلب
            Log::info('Sending payment request to Square');
            $paymentResponse = $client->payments->create(request: $paymentRequest);
            $payment = $paymentResponse->getPayment();

            Log::info('Payment successful', ['payment_id' => $payment->getId()]);

            // حفظ بيانات الدفع في قاعدة البيانات
            Payment::create([
                'user_id' => auth()->id(),
                'payment_id' => $payment->getId(),
                'status' => $payment->getStatus(),
                'amount' => $amountCents,
                'order_id' => $orderId,
                'currency' => $payment->getAmountMoney()->getCurrency(),
                'payment_method' => $payment->getCardDetails()?->getCard()?->getCardType(),
                'card_brand' => $payment->getCardDetails()?->getCard()?->getCardBrand(),
                'card_last_4' => $payment->getCardDetails()?->getCard()?->getLast4(),
                'idempotency_key' => $idempotencyKey,
                'response_data' => json_encode($paymentResponse),
            ]);

            Order::where('id', $orderId)->update([
                'order_status' => 'processing',
            ]);

            Cookie::queue(Cookie::forget('cart'));

            return redirect()->route('home')->with('success', 'Payment completed successfully! Thank you for shopping with us.');

        } catch (\Square\Exceptions\ApiException $e) {
            // التعامل مع أخطاء API
            Log::error('Square API error: ' . $e->getMessage());

            $errors = $e->getErrors();
            $details = collect($errors)->pluck('detail')->join('; ');

            // حفظ محاولة الدفع الفاشلة في قاعدة البيانات
            Payment::create([
                'user_id' => auth()->id(),
                'payment_id' => null,
                'status' => 'failed',
                'amount' => $amountCents,
                'currency' => Currency::Usd->value,
                'idempotency_key' => $idempotencyKey,
                'response_data' => json_encode($errors),
            ]);

            // فحص أكواد الأخطاء وإعطاء رسائل موجهة للمستخدم
            $errorMessages = collect($errors)->map(function($error) {
                if ($error['code'] === 'GENERIC_DECLINE') {
                    return 'Your payment was declined. Authorization error: ' . $error['detail'] . '. Please check your card details or try a different payment method.';
                } else {
                    return 'An error occurred while processing your payment. Please try again later.';
                }
            })->implode(' ');

            return redirect()->back()->with('error', 'Payment failed: ' . $errorMessages);
        } catch (\Exception $e) {
            // التعامل مع الأخطاء العامة
            Log::error('General error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    }












