<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id) {
        $book = Book::findOrFail($id);
        $cart = Cart::where('user_id', Auth::id())->where('book_id', $id)->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $id,
                'quantity' => 1,
                'total_price' => $book->price,
            ]);
        }

        return redirect()->back()->with('success', 'Book added to cart successfully.');
    }
    
    public function index() {
        $carts = Cart::with('book')->where('user_id', Auth::id())->get();
        $shippingOptions = [
            ['name' => 'Standard Shipping', 'cost' => 5000],
            ['name' => 'Express Shipping', 'cost' => 10000],
            ['name' => 'Next Day Shipping', 'cost' => 20000],
        ];

        return view('cart.index', compact('carts', 'shippingOptions'));
    }    

    public function checkout(Request $request){
        $selected_items = $request->input('selected_items', []);
        $request->validate([
            'shipping' => 'required',
        ]);

        if(empty($selected_items)){
            return redirect()->back()->with('error', 'Please select at least one item to checkout.');
        }

        $cartItems = Cart::whereIn('id', $selected_items)->with('book')->get();

        $shippingOptions = [
            ['name' => 'Standard Shipping', 'cost' => 5000],
            ['name' => 'Express Shipping', 'cost' => 10000],
            ['name' => 'Next Day Shipping', 'cost' => 20000],
        ];

        $shippingCost = $shippingOptions[$request->shipping] ?? 0;
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem->book->price * $cartItem->quantity;
        }
        $total += $shippingCost;

        // Process the order here
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_method' => $request->shipping,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $cartItem) {
            $book = Book::where('id', $cartItem->book->id);
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $cartItem->book->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->book->price,
            ]);
            $book->decrement('stock', $cartItem->quantity);
        }
        Cart::whereIn('id', $selected_items)
        ->where('user_id', Auth::id())
        ->delete();

        return redirect()->route('cart.index')->with('success', 'Checkout successful. Your order is being processed.');
    }

    public function deletedSelected(Request $request)
    {
        $selected_items = $request->input('selected_items', []);

        if (empty($selected_items)) {
            return redirect()->back()->with('error', 'Please select at least one item to delete.');
        }

        Cart::whereIn('id', $selected_items)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Selected items deleted successfully.');
    }
}
