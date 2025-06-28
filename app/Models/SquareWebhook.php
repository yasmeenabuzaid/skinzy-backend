<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquareWebhook extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان مختلفًا
    protected $table = 'square_webhooks';

    // السماح لهذه الأعمدة بالتعبئة الجماعية
    protected $fillable = [
        'event_id', // معرف الحدث
        'event_type', // نوع الحدث
        'payload', // البيانات التي تم استلامها
    ];

    // تحويل التاريخ إلى تنسيق مناسب
    protected $dates = ['created_at', 'updated_at'];
}

