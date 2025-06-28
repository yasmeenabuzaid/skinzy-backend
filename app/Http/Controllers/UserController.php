<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereIn('role', ['user', 'employee'])->get();

        return view('dashboard.user.index' , ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view ('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'Fname' => 'required|string|min:3',
            'Lname' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,',
            'mobile' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string',
        ]);

        User::create([
            'Fname'=>$request->input('Fname'),
            'Lname'=>$request->input('Lname'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password' => Hash::make($request->input('password')),
            'role'=>$request->input('role'),
        ]);



        return to_route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }



    public function show_profile_dash()
    {
        return view('dashboard.profile.profile');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $user = User::findOrFail($id);
      return view ('dashboard.user.edit' , ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'Fname' => 'required|string|min:3',
            'Lname' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'Fname'=>$request->input('Fname'),
            'Lname'=>$request->input('Lname'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password'=>$user->password,
            'role'=>$request->input('role'),
        ]);

        return to_route('users.index')->with('success', 'User updated successfully');
    }



    public function update_profile_dash(Request $request)
    {

        $validation = $request->validate([
            'Fname' => 'required|string|min:3',
            'Lname' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'mobile' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
        ]);

        // Get the authenticated user
        $user = auth()->user();


        $user->update([
            'Fname' => $request->input('Fname'),
            'Lname' => $request->input('Lname'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => $user->password, // Keeps the existing password unchanged
        ]);

        return back()->with('success', 'Profile updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->orders()->exists()) {
            return to_route('users.index')->with('error', 'Cannot delete a user with active orders.');
        }

        $user->delete();

        return to_route('users.index')->with('success', 'User deleted');
    }




    // public function trash()
    // {
    //      $deletedUsers = User::onlyTrashed()->get();
    //      return view('dashboard.user.trash' , ['deletedUsers' => $deletedUsers]);
    // }

    // public function restore($id)
    // {
    //     $user = User::withTrashed()->find($id);
    //     $user->restore();
    //     return redirect()->route('users.trash')->with('success', 'User restored successfully');
    // }



public function profile()
{
    $user = auth()->user();


    if ($user->role === 'manager' || $user->role === 'employee') {

        return redirect()->route('profile_dash.show');
    }

    $orders = $user->orders()->with('orderDetails.product')->orderBy('created_at', 'desc')->get();

    return view('profile', compact('user', 'orders'));
}




    public function update_profile(Request $request)
    {
        $request->validate([
          'Fname' => 'required|string|min:3|max:255',
          'Lname' => 'required|string|min:3|max:255',
          'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
          'mobile' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
          'current_password' => 'nullable|required_with:new_password',
          'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user = auth()->user();


        if ($request->filled('new_password')) {
           if (!Hash::check($request->current_password, $user->password)) {
               return back()->withErrors(['current_password' => 'The current password is incorrect.']);
           }
        $user->password = Hash::make($request->new_password);
        }


        $user->update([
          'Fname' => $request->input('Fname'),
          'Lname' => $request->input('Lname'),
          'email' => $request->input('email'),
          'mobile' => $request->input('mobile'),
        ]);

        return back()->with('success', 'Account settings updated successfully.');
    }

    public function getOrderDetails($id)
    {
        try {
            // Find the order with related details
            $order = Order::with(['orderDetails.product'])->findOrFail($id);

            // Return a JSON response with the order details
            return response()->json([
                'success' => true,
                'details' => $order->orderDetails->map(function ($detail) {
                    return [
                        'product' => $detail->product->name,
                        'quantity' => $detail->quantity,
                        'price' => $detail->price,
                        'discount' => $detail->discount,
                        'total_price' => $detail->total_price,
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order details could not be retrieved.',
            ], 500);
        }
    }


}
