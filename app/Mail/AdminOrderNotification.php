<?php

// namespace App\Mail;

// use App\Models\Order;
// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

// class AdminOrderNotification extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $order;

//     public function __construct(Order $order)
//     {
//         $this->order = $order;
//     }

//     public function build()
//     {
//         return $this->subject('تنبيه: طلب جديد بإنتظار الدفع')
//                     ->view('emails.admin_order_notification');
//     }
// }



// app/Mail/AdminOrderNotification.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class AdminOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Test Email: New Order #' . $this->order->id)
                    ->view('emails.admin_order_notification')
                    ->with([
                        'message' => 'هذا اختبار لإرسال البريد الإلكتروني.',
                    ]);
    }
}
