<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنبيه: طلب جديد بانتظار الدفع</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 680px; margin: 30px auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

        <tr>
            <td style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <h1 style="font-size: 24px; font-weight: 800; color: #1e293b; margin: 0;">
                                🚨 طلب جديد بانتظار الدفع
                            </h1>
                            <p style="font-size: 15px; color: #64748b; margin: 4px 0 0 0;">
                                مطلوب إجراء لمراجعة وتأكيد استلام الدفع.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 20px;">
                    <tr>
                        <td width="50%" valign="top">
                            <p style="font-size: 14px; color: #78350f; margin: 0 0 4px 0;">رقم الطلب</p>
                            <p style="font-size: 20px; color: #78350f; font-weight: 700; margin: 0;">#{{ $order->id }}</p>
                        </td>
                        <td width="50%" valign="top">
                            <p style="font-size: 14px; color: #78350f; margin: 0 0 4px 0;">المبلغ الإجمالي</p>
                            <p style="font-size: 20px; color: #78350f; font-weight: 700; margin: 0;">
                                {{ $order->total_price }} {{ config('app.currency', 'د.أ') }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding: 0 24px 24px 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="50%" valign="top" style="padding-right: 12px;">
                            <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0;">
                                بيانات العميل
                            </h2>
                            <p style="font-size: 15px; color: #475569; margin: 0 0 8px 0;">
                                <strong>الاسم:</strong> {{ $order->user->Fname ?? 'غير معروف' }} {{ $order->user->Lname ?? '' }}
                            </p>
                            <p style="font-size: 15px; color: #475569; margin: 0 0 8px 0;">
                                <strong>الإيميل:</strong> {{ $order->user->email ?? 'غير متوفر' }}
                            </p>
                            <p style="font-size: 15px; color: #475569; margin: 0;">
                                <strong>الهاتف:</strong> {{ $order->user->mobile ?? 'غير متوفر' }}
                            </p>
                        </td>
                        <td width="50%" valign="top" style="padding-left: 12px;">
                            <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0;">
                                تفاصيل الطلب
                            </h2>
                            <p style="font-size: 15px; color: #475569; margin: 0 0 8px 0;">
                                <strong>الشحن:</strong> {{ $order->shipping_method === 'home_delivery' ? 'توصيل للمنزل' : 'استلام من الفرع' }}
                            </p>
                            <p style="font-size: 15px; color: #475569; margin: 0 0 8px 0;">
                                <strong>الدفع:</strong> {{ $order->payment_method === 'cash_on_delivery' ? 'الدفع عند الاستلام' : ($order->payment_method === 'stripe' ? 'Stripe' : 'تحويل بنكي') }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        @if($order->note)
            <tr>
                <td style="padding: 0 24px 24px 24px;">
                     <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0;">
                        ملاحظات العميل
                    </h2>
                    <p style="font-size: 15px; color: #475569; margin: 0; padding: 16px; background-color: #f8fafc; border-radius: 8px;">
                        {{ $order->note }}
                    </p>
                </td>
            </tr>
        @endif

        <tr>
            <td align="center" style="padding: 0 24px 30px 24px;">
                <a href="https://saddlebrown-eagle-408332.hostingersite.com/" target="_blank" style="display: block; width: 90%; padding: 14px 0; background-color: #4338ca; color: #ffffff; font-size: 16px; font-weight: 600; text-decoration: none; border-radius: 8px; text-align: center;">
                    مراجعة الطلب في لوحة التحكم
                </a>
            </td>
        </tr>
    </table>
</body>
</html>
