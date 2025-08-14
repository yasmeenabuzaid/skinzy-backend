<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تحديث حالة الطلب</title>
    <style>
        /* 기본 스타일 */
        body {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
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
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            text-align: right;
            color: #333333;
            line-height: 1.6;
        }
        .content h2 {
            color: #FF671F;
            font-size: 20px;
        }
        .status-box {
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            background-color: #f9f9f9;
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
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
        }
        .total-row td {
            font-size: 18px;
            font-weight: bold;
            border-top: 2px solid #FF671F;
            color: #FF671F;
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
            font-weight: bold;
            display: inline-block;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table class="container" align="center" style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-collapse: collapse;">
        <tr>
            <td class="content" style="padding: 30px; text-align: right; color: #333333; line-height: 1.6;">
                <h2 style="color: #FF671F; font-size: 20px;">تم تحديث حالة طلبك</h2>
                <p>مرحباً {{ $order->user->name }}،</p>
                <p>نود إعلامك بأنه تم تحديث حالة طلبك رقم <strong>#{{ $order->id }}</strong>.</p>

                <div class="status-box" style="border: 1px solid #e0e0e0; padding: 15px; margin: 20px 0; border-radius: 8px; background-color: #f9f9f9;">
                    <p style="margin: 5px 0;"><strong>الحالة السابقة:</strong> {{ ucfirst($oldStatus) }}</p>
                    <p style="margin: 5px 0;"><strong>الحالة الجديدة:</strong> <span style="color: #FF671F; font-weight: bold;">{{ ucfirst($order->order_status) }}</span></p>
                </div>

                <h3 style="color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">ملخص الطلب</h3>

                <table class="order-table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: right; background-color: #f2f2f2; font-weight: bold; color: #555;">المنتج</th>
                            <th style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: bold; color: #555;">الكمية</th>
                            <th style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: left; background-color: #f2f2f2; font-weight: bold; color: #555;">السعر</th>
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
                            <td colspan="2" style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: right; font-size: 18px; font-weight: bold; color: #FF671F; border-top: 2px solid #FF671F;">
                                <strong>المجموع الكلي</strong>
                            </td>
                            <td style="border-bottom: 1px solid #dddddd; padding: 12px; text-align: left; font-size: 18px; font-weight: bold; color: #FF671F; border-top: 2px solid #FF671F;">
                                <strong>{{ number_format($order->final_price, 2) }} د.أ</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="button-container" style="text-align: center; margin-top: 30px;">
                    <a href="{{-- ضع هنا رابط عرض الطلب في موقعك --}}" class="button" style="background-color: #FF671F; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                        عرض الطلب
                    </a>
                </div>
            </td>
        </tr>

        <tr>
            <td class="footer" style="padding: 20px; text-align: center; font-size: 12px; color: #777777;">
                <p>&copy; {{ date('Y') }} Skinzy Care. جميع الحقوق محفوظة.</p>
            </td>
        </tr>
    </table>
</body>
</html>
