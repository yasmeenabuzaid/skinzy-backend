<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $favorite = Favorite::firstOrCreate([
            'user_id' => $validated['user_id'],
            'product_id' => $validated['product_id'],
        ]);

        return response()->json(['message' => 'تمت الإضافة للمفضلة', 'favorite' => $favorite], 201);
    }

    public function index($user_id)
    {
        $favorites = Favorite::with('product')->where('user_id', $user_id)->get();
        return response()->json($favorites);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);

        Favorite::where('user_id', $validated['user_id'])
            ->where('product_id', $validated['product_id'])
            ->delete();

        return response()->json(['message' => 'تمت الإزالة من المفضلة']);
    }
}
