<?php

namespace App\Http\Controllers;

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

        $transaction = DB::table('pos')->count();
        $TPkotor = DB::table('pos')->sum('total_belanja'); // Total pendapatan kotor

        $TPbersih = DB::table('pos_details')
            ->join('barangs', 'pos_details.barang_id', '=', 'barangs.id')
            ->select(DB::raw('SUM((barangs.hargaJual - (barangs.hargaBeli / GREATEST(barangs.stok, 1))) * pos_details.quantity) AS total_bersih'))
            ->value('total_bersih');


        return view('home', compact('transaction', 'TPkotor', 'TPbersih'));
    }
}
