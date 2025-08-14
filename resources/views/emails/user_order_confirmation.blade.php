<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم تأكيد طلبك بنجاح!</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f7f7; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 640px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

        <tr>
            <td align="center" style="padding: 20px 0;">
                <img src="https://skinzy-ecommerce-z4p6.vercel.app/logo.png" alt="Skinzy Care Logo" width="120">
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 0 30px;">
                <h1 style="font-size: 28px; font-weight: 800; color: #111827; margin: 16px 0 8px 0;">شكراً لطلبك!</h1>
                <p style="font-size: 16px; color: #4b5563; margin: 0; line-height: 1.6;">مرحباً {{ $order->user->Fname ?? $order->user->name ?? 'عميلنا الكريم' }}، لقد تم استلام طلبك بنجاح وهو الآن قيد <strong>المعالجة</strong>.</p>
                <p style="font-size: 15px; color: #4b5563; margin-top: 8px;"><strong>رقم الطلب:</strong> #{{ $order->id }}</p>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px 30px 20px 30px;">
                <h2 style="font-size: 20px; font-weight: 700; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #f3f4f6; padding-bottom: 8px;">ملخص الطلب</h2>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        @foreach($order->orderDetails as $item)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 16px 0 16px 16px;" width="72">
 <img
      src="{{ $item->product->image ?? 'https://via.placeholder.com/64' }}"
      alt="{{ $item->product->name ?? '' }}"
      width="64"
      height="64"
      style="border-radius: 8px; object-fit: cover;"
    >                                </td>
                                <td style="padding: 16px 0;" valign="middle">
                                    <p style="font-size: 16px; font-weight: 600; color: #1f2937; margin: 0;">
                                        {{ $item->product->name ?? 'منتج غير متوفر' }}
                                    </p>
                                    <p style="font-size: 14px; color: #6b7280; margin: 4px 0 0 0;">
                                        الكمية: {{ $item->quantity }}
                                    </p>
                                </td>
                                <td align="left" style="padding: 16px 0; font-size: 16px; font-weight: 600; color: #1f2937;" valign="middle">
                                    {{ number_format($item->total_price, 2) }} {{ config('app.currency', 'د.أ') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding: 0 30px 20px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fafafa; border-radius: 8px; padding: 16px;">
                    <tr>
                        <td style="padding: 6px 0; font-size: 15px; color: #4b5563;">المجموع الفرعي</td>
                        <td align="left" style="padding: 6px 0; font-size: 15px; color: #4b5563; font-weight: 500;">
                           {{-- صيغة محسنة لحساب المجموع الفرعي --}}
                           {{ number_format($order->total_price, 2) }} {{ config('app.currency', 'د.أ') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; font-size: 15px; color: #4b5563;">
                            رسوم التوصيل
                            @if($order->total_price >= 15)
                                <span style="font-size:13px; color: #16a34a; font-weight: bold;"> (توصيل مجاني 🎉)</span>
                            @endif
                        </td>
                        <td align="left" style="padding: 6px 0; font-size: 15px; color: #4b5563; font-weight: 500;">
                            {{-- صيغة محسنة لحساب رسوم التوصيل --}}
                            {{ number_format($order->final_price - $order->total_price, 2) }} {{ config('app.currency', 'د.أ') }}
                        </td>
                    </tr>
                    <tr style="border-top: 2px solid #e5e7eb;">
                        <td style="padding: 12px 0 0 0; font-size: 18px; font-weight: 700; color: #111827;">المبلغ الإجمالي</td>
                        <td align="left" style="padding: 12px 0 0 0; font-size: 18px; font-weight: 700; color: #111827;">
                            {{ number_format($order->final_price, 2) }} {{ config('app.currency', 'د.أ') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="50%" valign="top" style="padding-right: 10px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #111827; margin: 0 0 8px 0;">🚚 طريقة الشحن</h3>
                            <p style="font-size: 15px; color: #4b5563; margin: 0;">{{ $order->shipping_method === 'home_delivery' ? 'توصيل إلى المنزل' : 'استلام من الفرع' }}</p>
                        </td>
                        <td width="50%" valign="top" style="padding-left: 10px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #111827; margin: 0 0 8px 0;">💳 طريقة الدفع</h3>
                            <p style="font-size: 15px; color: #4b5563; margin: 0;">
                                @switch($order->payment_method)
                                    @case('cash_on_delivery') الدفع عند الاستلام @break
                                    @case('stripe') Stripe @break
                                    @case('bank_transfer') تحويل بنكي @break
                                    @default غير معروف
                                @endswitch
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- <tr>
            <td align="center" style="padding: 20px 30px 30px 30px;">
                <a href="{{ url('/user/orders/' . $order->id) }}" target="_blank" style="display: inline-block; padding: 14px 28px; background-color: #db2777; color: #ffffff; font-size: 16px; font-weight: 600; text-decoration: none; border-radius: 8px;">
                    عرض حالة الطلب
                </a>
            </td>
        </tr> --}}

        <tr>
            <td align="center" style="padding: 20px 30px; background-color: #f9fafb; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <p style="font-size: 14px; color: #6b7280; margin: 0;">إذا كان لديك أي استفسار، لا تتردد في <a href="mailto:support@skinzy.care" style="color: #db2777; text-decoration: none;">التواصل معنا</a>.</p>
                <p style="font-size: 14px; color: #6b7280; margin: 8px 0 0 0;">نتمنى لك يوماً سعيداً 💖</p>
            </td>
        </tr>
    </table>
</body>
</html>
