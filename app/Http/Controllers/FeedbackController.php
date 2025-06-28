<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Show all feedbacks
    public function index()
    {
        $feedbacks = Feedback::with('user')->get();
        return view('dashboard.feedbacks.index', ['feedbacks' => $feedbacks]);
    }

    // Store a new feedback
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        Feedback::create([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    // Delete a feedback
    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();
            return redirect()->back()->with('success', 'The feedback was deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred during deletion: ' . $e->getMessage());
        }
    }
}
