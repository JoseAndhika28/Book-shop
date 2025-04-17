<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    // Fungsi checkout: user membeli buku dari keranjang
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Simpan order
        Order::create([
            'user_id' => Auth::id(),
            'order_id' => $request->id,
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'total' => $total,
            'status' => 'pending', // default
        ]);

        // Hapus keranjang
        session()->forget('cart');

        return redirect()->route('orders.success')->with('success', 'Pesanan berhasil dilakukan!');
    }

    // Admin: Menampilkan semua pesanan
    public function adminIndex()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Admin: Konfirmasi pesanan
    public function confirm(Order $order)
    {
        $order->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Pesanan telah dikonfirmasi.');
    }
}
