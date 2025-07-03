<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pos;
use App\Models\PosDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $transaction = Pos::count();
        $data = PosDetail::with('barang')
            ->get();

        $TPkotor = $data->sum(function ($transaction) {
            return $transaction->quantity * $transaction->barang->hargaJual;
        });

        $TPbersih = $data->sum(function ($transaction) {
            $hargaPerItem = $transaction->barang->hargaBeli / $transaction->barang->stok;
            return ($transaction->barang->hargaJual - $hargaPerItem) * $transaction->quantity;
        });
        return view('home', compact('transaction', 'TPkotor', 'TPbersih'));
    }
}
