<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;

class TransaksiPosController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->q) {
            $transactions = Pos::query()
                ->with(['details.customer'])
                ->where(function ($query) use ($request) {
                    $query->where('kode_transaksi', 'like', '%' . $request->q . '%')
                        ->orWhere('total_belanja', 'like', '%' . $request->q . '%')
                        ->orWhereHas('details.customer', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->q . '%');
                        });
                })->paginate(10);
        } else {
            $transactions = Pos::with(['details.customer'])->paginate(10);
        }
        return view('transaksi.index', compact('transactions'));
    }

    function show(Pos $pos)
    {
        $pos->load('details.barang', 'details.customer');
        return view('transaksi.show', compact('pos'));
    }

    public function destroy(Pos $pos)
    {
        $pos->details()->delete();
        $pos->delete();
        return redirect()->route('transaksi-pos.index')->with('success', 'Transaction and related details deleted successfully.');
    }

    public function filter(Request $request)
    {
        try {
            $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay();
            $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Invalid date format. Please use dd/mm/yyyy.']);
        }

        $transactions = Pos::with('details.customer', 'details.barang')
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();

        return view('transaksi.filter', compact('transactions', 'start_date', 'end_date'));
    }

    public function invoice($id)
    {
        $transaction = Pos::with('details.barang')->findOrFail($id);
        return view('transaksi.invoice', compact('transaction'));
    }

    public function showFilterPage()
    {
        return view('transaksi.filter');
    }

    public function printFilteredTransactions(Request $request)
    {
        try {
            $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay();
            $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Invalid date format. Please use dd/mm/yyyy.']);
        }

        $transactions = Pos::with('details.customer', 'details.barang')
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();

        return view('transaksi.invoiceFilter', compact('transactions', 'start_date', 'end_date'));
    }
}
