<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pos;
use App\Http\Requests\PosRequest;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        if (!session('customer_name')) {
            return view('pos.customer');
        }

        $barangs = Barang::all();
        $cart = session('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['quantity'] * $item['barang']->hargaJual;
        });

        return view('pos.index', compact('barangs', 'cart', 'total'));
    }

    public function customer()
    {
        return view('pos.customer');
    }

    public function setCustomer(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
        ]);

        $request->session()->put('customer_name', $request->customer_name);

        return redirect()->route('pos.index');
    }

    public function clearCustomer(Request $request)
    {
        $request->session()->forget('customer_name');
        $request->session()->forget('cart');

        return redirect()->route('pos.customer');
    }

    public function store(PosRequest $request)
    {
        $barang = Barang::findOrFail($request->barang_id);
        if ($request->quantity > $barang->stok) {
            return redirect()->route('pos.index')->with('error', 'Stok tidak mencukupi untuk pembelian barang.');
        }

        $cart = session('cart', []);
        $cart[] = [
            'barang' => $barang,
            'quantity' => $request->quantity,
        ];
        $request->session()->put('cart', $cart);

        return redirect()->route('pos.index');
    }

    public function destroy($index)
    {
        $cart = session('cart', []);
        unset($cart[$index]);
        session(['cart' => $cart]);

        return redirect()->route('pos.index');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        foreach ($cart as $item) {
            Pos::create([
                'barang_id' => $item['barang']->id,
                'quantity' => $item['quantity'],
                'customer_name' => session('customer_name'),
            ]);

            // Reduce the stock of the item
            $barang = Barang::findOrFail($item['barang']->id);
            $barang->stok -= $item['quantity'];
            $barang->save();
        }

        $request->session()->forget('customer_name');
        $request->session()->forget('cart');

        return redirect()->route('pos.index')->with('success', 'Checkout successful!');
    }
}
