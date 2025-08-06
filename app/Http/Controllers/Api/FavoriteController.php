<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

public function store(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $user = Auth::guard('sanctum')->user(); 
    if (!$user) {
        return response()->json(['message' => 'User not authenticated'], 401);
    }

    $favorite = Favorite::firstOrCreate([
        'user_id' => $user->id,
        'product_id' => $validated['product_id'],
    ]);

    return response()->json(['message' => 'تمت الإضافة للمفضلة', 'favorite' => $favorite], 201);
}


public function index()
{
    $user = Auth::guard('sanctum')->user();
    if (!$user) {
        return response()->json([
            'message' => 'You must be logged in to view favorites'
        ], 401);
    }

    $favorites = Favorite::with(['product.images'])->where('user_id', $user->id)->get();

    return response()->json($favorites);
}

}
