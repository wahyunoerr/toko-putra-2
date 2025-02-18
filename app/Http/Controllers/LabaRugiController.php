<?php

namespace App\Http\Controllers;

use App\Models\PosDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LabaRugiController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil tanggal mulai dan selesai dari request
        $start_date = $request->start_date ? Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay() : null;
        $end_date = $request->end_date ? Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay() : null;

        // Query transaksi dengan filter tanggal jika ada
        $transactions = PosDetail::with('barang')
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->get();

        // Menghitung total pendapatan kotor dan bersih
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
