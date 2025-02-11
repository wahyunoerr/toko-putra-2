<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function index()
    {
        $transactions = Pos::with('barang')->get();
        $totalPendapatanKotor = $transactions->sum(function ($transaction) {
            return $transaction->quantity * $transaction->barang->hargaJual;
        });
        $totalPendapatanBersih = $transactions->sum(function ($transaction) {
            $hargaPerItem = $transaction->barang->hargaBeli / $transaction->barang->stok;
            return ($transaction->barang->hargaJual - $hargaPerItem) * $transaction->quantity;
        });

        return view('laba-rugi.index', compact('transactions', 'totalPendapatanKotor', 'totalPendapatanBersih'));
    }
}
