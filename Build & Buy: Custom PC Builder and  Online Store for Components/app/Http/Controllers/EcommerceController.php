<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\Order;



class EcommerceController extends Controller{

    public function showCategory($category)
    {
        $components = Component::where('type', $category)->get();
        return view('ecommerce.category', compact('components', 'category'));
    }



    public function showCart()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];

        if ($cart) {
            foreach ($cart as $id => $item) {
                $component = Component::find($id);
                if ($component) {
                    $cartItems[] = [
                        'id' => $component->id,
                        'name' => $component->name,
                        'price' => $component->price,
                        'quantity' => $item['quantity'],
                        'type' => $component->type,
                        'brand' => $component->brand,
                    ];
                }
            }
        }

        $totalPrice = array_reduce($cartItems, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return view('ecommerce.cart', compact('cartItems', 'totalPrice'));
    }

    // Place the order
    public function placeOrder(Request $request)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            $cart = session()->get('cart', []);
            $totalPrice = 0;
            $orderDetails = [];

            foreach ($cart as $id => $item) {
                $component = Component::find($id);
                if ($component) {
                    $orderDetails[] = [
                        'name' => $component->name,
                        'quantity' => $item['quantity'],
                        'total_price' => $component->price * $item['quantity'],
                    ];
                    $totalPrice += $component->price * $item['quantity'];
                }
            }

            // Create a new order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'order_details' => json_encode($orderDetails),  // Store order details as JSON
            ]);

            // Reset the cart
            session()->forget('cart');

            return redirect()->route('ecommerce.dashboard')->with('success', 'Order placed successfully!');
        } else {
            return redirect()->route('ecommerce.login')->with('error', 'Please log in to place an order!');
        }
    }


    public function addToCart($type, $id)
    {
        $component = Component::find($id);

        if ($component) {
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'name' => $component->name,
                    'price' => $component->price,
                    'quantity' => 1,
                    'type' => $component->type,
                    'brand' => $component->brand,
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('ecommerce.category', ['category' => $type]);


    }

    public function updateQuantity($id, $quantity)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Prevent quantity from going below 1
            $cart[$id]['quantity'] = max(1, $quantity);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.page');
    }

    public function resetCart()
    {
        session()->forget('cart');
        return redirect()->route('cart.page');
    }

    // Show the login page
    public function login()
    {
        return view('ecommerce.login');
    }

    // Show the registration page
    public function register()
    {
        return view('ecommerce.register');
    }

    // Handle the registration form submission
    public function registerSubmit(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone_number' => $validated['phone_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'role' => 'customer', // Default role is customer
        ]);

        // Log the user in
        //Auth::login($user);
        return redirect()->route('main.page');
    }

    // Handle the login form submission
    public function loginSubmit(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        // Attempt to log in
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $user = Auth::user();
            session(['user_name' => $user->name]);
            return redirect()->route('ecommerce.dashboard');
        }

        // If login fails
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // Handle user logout
    public function logout()
    {
        Auth::logout();
        session()->forget('user_name');
        return redirect()->route('main.page');
    }

    public function dashboard()
    {
        // Check if a user is logged in
        if (!Auth::check()) {
            return redirect()->route('ecommerce.login')->with('error', 'Please log in to view your dashboard.');
        }

        // Get the logged-in user's ID
        $userId = Auth::id();

        // Fetch orders for the logged-in user
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();




        // Pass user, orders, and orderIds to the view
        return view('ecommerce.dashboard', compact('orders'));
    }



}

