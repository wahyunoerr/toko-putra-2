<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pos;
use App\Http\Requests\PosRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PosDetail;

class PosController extends Controller
{
    public function index()
    {
        if (!session('customer_name')) {
            return view('pos.customer', ['customers' => Customer::all()]);
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
        return view('pos.customer', ['customers' => Customer::all()]);
    }

    public function setCustomer(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|min:2',
            'customer_phone' => 'nullable|string|max:12',
        ]);

        $customer = Customer::firstOrCreate(
            ['name' => $request->customer_name],
            ['phone' => $request->customer_phone]
        );

        $request->session()->put('customer_name', $customer->name);
        $request->session()->put('customer_id', $customer->id);

        return redirect()->route('pos.index');
    }

    public function clearCustomer(Request $request)
    {
        $request->session()->forget('customer_name');
        $request->session()->forget('customer_id');
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
        $total = collect($cart)->sum(function ($item) {
            return $item['quantity'] * $item['barang']->hargaJual;
        });

        $customer_id = session('customer_id');

        $pos = Pos::create([
            'kode_transaksi' => 'TRX-' . time() . '-TP2',
            'total_belanja' => $total,
        ]);

        foreach ($cart as $item) {
            PosDetail::create([
                'pos_id' => $pos->id,
                'barang_id' => $item['barang']->id,
                'customer_id' => $customer_id,
                'quantity' => $item['quantity'],
                'sub_total' => $item['quantity'] * $item['barang']->hargaJual,
            ]);

            $barang = Barang::findOrFail($item['barang']->id);
            $barang->stok -= $item['quantity'];
            $barang->save();
        }

        $request->session()->forget('customer_name');
        $request->session()->forget('customer_id');
        $request->session()->forget('cart');

        return redirect()->route('transaksi-pos.invoice', ['id' => $pos->id])->with('success', 'Checkout successful!');
    }
}
