<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Fname',
        'Lname',
        'mobile',
        'email',
        'subject',
        'message',
        'created_at',
        'updated_at',
    ];
}
