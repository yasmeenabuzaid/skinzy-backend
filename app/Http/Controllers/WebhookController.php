<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SquareWebhook;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    // استقبال الويب هوك
    public function handle(Request $request)
    {
        Log::info('Webhook received', ['payload' => $request->all()]);

        // حفظ البيانات الواردة من سكوير في قاعدة البيانات
        SquareWebhook::create([
            'event_id' => $request->input('event_id'),
            'event_type' => $request->input('type'),
            'payload' => json_encode($request->all()),
        ]);

        // الرد بـ OK ليؤكد استلام البيانات
        return response()->json(['status' => 'ok']);
    }

    // عرض الأحداث المخزنة في الـ Dashboard
    public function showWebhookEvents()
    {
        $events = SquareWebhook::latest()->get();
        return view('dashboard.webhook.index', compact('events'));
    }
}
