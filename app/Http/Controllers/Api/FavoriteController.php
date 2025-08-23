<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        $favorite = Favorite::updateOrCreate(
            [
                'user_id' => $user->id,
                'product_id' => $validated['product_id'],
            ],
            [
                'is_active' => true,
            ]
        );

        return response()->json(['success' => true, 'message' => 'تمت الإضافة للمفضلة بنجاح', 'favorite' => $favorite], 201);
    }

    /**
     */
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to view favorites'], 401);
        }

        $favorites = Favorite::with(['product.images'])
            ->where('user_id', $user->id)
            ->where('is_active', true) // <-- هذا السطر مهم جدًا
            ->get();

        return response()->json([
            'success' => true,
            'favorites' => $favorites
        ]);
    }



    public function destroy($productId)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

        if (!$favorite) {
            return response()->json(['success' => false, 'message' => 'Favorite item not found'], 404);
        }

        $favorite->is_active = false;
        $favorite->save();

        return response()->json(['success' => true, 'message' => 'تمت الإزالة من المفضلة بنجاح']);
    }
    // ====================================================================
    // ====================================================================
}
