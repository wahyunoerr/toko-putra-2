<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;

class TransaksiPosController extends Controller
{
    public function index()
    {
        $transactions = Pos::with('barang')->get();
        return view('transaksi.index', compact('transactions'));
    }

    public function destroy(Pos $pos)
    {
        $pos->delete();
        return redirect()->route('transaksi-pos.index')->with('success', 'Transaction deleted successfully.');
    }
}
