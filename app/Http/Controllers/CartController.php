<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Models\ProductImage;

class CartController extends Controller
{


    public function index()
    {
        $cart = json_decode(Cookie::get('cart', json_encode([])), true) ?? [];

        return view('cart', compact('cart'));
    }




    public function addToCart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0|max:100',
            'final_price' => 'required|numeric',
            'small_description' => 'required|string',
        ]);

        $cart = json_decode(Cookie::get('cart', json_encode([])), true);

        $product = \App\Models\Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cartItem = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'final_price' => $request->final_price,
            'small_description' => $request->small_description,
        ];

        if (isset($cart[$cartItem['product_id']])) {
            $cart[$cartItem['product_id']]['quantity'] += $cartItem['quantity'];
        } else {
            $cart[$cartItem['product_id']] = $cartItem;
        }


        return redirect()->back()->with('success', 'Product added to cart successfully!')
            ->cookie('cart', json_encode($cart), 60 * 24 * 7); // Set cookie for 1 week
    }






    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        $cart = json_decode(Cookie::get('cart', json_encode([])), true);


        if (isset($cart[$productId])) {

            $cart[$productId]['quantity'] = $request->quantity;


            return redirect()->back()->with('success', 'Cart updated successfully!')
                ->cookie('cart', json_encode($cart), 60 * 24 * 7);
        } else {
            return redirect()->back()->with('error', 'Product not found in cart.');
        }
    }


    public function deleteCartItem($product_id)
    {
        $cart = json_decode(Cookie::get('cart', json_encode([])), true);

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]); // Remove item from cart
        }

        return redirect()->back()->cookie('cart', json_encode($cart), 60 * 24 * 7);
    }




    public function clear()
    {
        // Set the cart cookie to an empty array
        Cookie::queue(Cookie::forget('cart'));


        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }



}
