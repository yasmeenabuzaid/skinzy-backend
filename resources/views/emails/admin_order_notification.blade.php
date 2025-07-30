<h2>طلب جديد بانتظار الدفع</h2>
<p>رقم الطلب: #{{ $order->id }}</p>
<p>المستخدم: {{ $order->user->name ?? 'غير معروف' }}</p>
<p>المبلغ الإجمالي: {{ $order->total_price }} {{ config('app.currency', 'د.أ') }}</p>
<p>طريقة الدفع: {{ $order->payment_method }}</p>
<p>الرجاء مراجعة الطلب من لوحة التحكم.</p>
