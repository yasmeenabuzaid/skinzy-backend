<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تحديث حالة الطلب</title>
    <style>
        /* This is a fallback for clients that support it */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
        body {
            font-family: 'Cairo', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
            text-align: right;
            color: #333333;
            line-height: 1.7;
        }
        .content h2 {
            color: #FF671F;
            font-size: 22px;
            font-weight: 700;
        }
        .status-box {
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            background-color: #fafafa;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .order-table th, .order-table td {
            border-bottom: 1px solid #dddddd;
            padding: 12px;
            text-align: right;
        }
        .order-table th {
            background-color: #f8f8f8;
            font-weight: 700;
            color: #555;
        }
        .total-row td {
            font-size: 18px;
            font-weight: 700;
            border-top: 2px solid #FF671F;
            color: #FF671F;
            padding-top: 15px;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .button {
            background-color: #FF671F;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 700;
            display: inline-block;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body style="font-family: 'Cairo', Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0;">
                <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-collapse: collapse; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td class="content" style="padding: 30px; text-align: right; color: #333333; line-height: 1.7;">
                            <h2 style="color: #333; font-size: 20px; font-weight: 700;">مرحباً {{ $order->user->name }},</h2>
                            <p style="font-size: 16px;">تم تحديث حالة طلبك رقم <strong>#{{ $order->id }}</strong>.</p>

                            <table class="status-box" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #e0e0e0; padding: 15px; margin: 20px 0; border-radius: 8px; background-color: #fafafa;">
                                <tr>
                                    <td>
                                        <p style="margin: 5px 0;"><strong>الحالة السابقة:</strong> {{ ucfirst($oldStatus) }}</p>
                                        <p style="margin: 5px 0;"><strong>الحالة الجديدة:</strong> <span style="color: #FF671F; font-weight: bold;">{{ ucfirst($order->order_status) }}</span></p>
                                    </td>
                                </tr>
                            </table>

                            <h3 style="color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; margin-top: 30px; font-size: 18px;">تفاصيل الطلب</h3>

                            <table class="order-table" border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: right; background-color: #f8f8f8; font-weight: 700; color: #555;">المنتج</th>
                                        <th style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #f8f8f8; font-weight: 700; color: #555;">الكمية</th>
                                        <th style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: left; background-color: #f8f8f8; font-weight: 700; color: #555;">السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderDetails as $detail)
                                    <tr>
                                        <td style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: right;">{{ $detail->product->name }}</td>
                                        <td style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: center;">{{ $detail->quantity }}</td>
                                        <td style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: left;">{{ number_format($detail->price, 2) }} د.أ</td>
                                    </tr>
                                    @endforeach

                                    <tr class="total-row">
                                        <td colspan="2" style="border-bottom: none; padding: 12px; text-align: right; font-size: 18px; font-weight: 700; color: #FF671F; padding-top: 15px; border-top: 2px solid #FF671F;">
                                            المجموع الكلي
                                        </td>
                                        <td style="border-bottom: none; padding: 12px; text-align: left; font-size: 18px; font-weight: 700; color: #FF671F; padding-top: 15px; border-top: 2px solid #FF671F;">
                                            {{ number_format($order->final_price, 2) }} د.أ
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="footer" style="padding: 30px; text-align: center; font-size: 14px; color: #888888;">
                            <p style="margin:0;">شكراً لتسوقك معنا!</p>
                            <p style="margin:10px 0 0 0; font-size: 12px;">&copy; {{ date('Y') }} Skinzy Care. جميع الحقوق محفوظة.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
