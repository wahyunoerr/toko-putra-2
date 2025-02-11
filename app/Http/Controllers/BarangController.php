<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->q) {
            $barangs = Barang::search($request->q)->query(function ($query) use ($request) {
                $query->with('jenis', 'satuan', 'supplier')
                    ->orWhereHas('jenis', function ($q) use ($request) {
                        $q->where('nama', 'like', '%' . $request->q . '%');
                    })
                    ->orWhereHas('satuan', function ($q) use ($request) {
                        $q->where('nama', 'like', '%' . $request->q . '%');
                    })
                    ->orWhereHas('supplier', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->q . '%');
                    });
            })->paginate(10);
        } else {
            $barangs = Barang::with('jenis', 'satuan', 'supplier')->latest()->paginate(10);
        }

        $lowStockItems = Barang::where('stok', '<', 10)->get();
        if ($lowStockItems->isNotEmpty()) {
            $lowStockMessage = 'Stok anda mulai menipis: ';
            foreach ($lowStockItems as $item) {
                $lowStockMessage .= $item->name . ' (' . $item->stok . '), ';
            }
            session()->flash('warning', rtrim($lowStockMessage, ', '));
        }

        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = JenisBarang::all();
        $satuan = SatuanBarang::all();
        $suppliers = Supplier::all();

        return view('barang.create', compact('jenis', 'satuan', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        Barang::create($request->validated());
        return redirect()->route('barang.index')->with('success', 'Barang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $jenis = JenisBarang::all();
        $satuan = SatuanBarang::all();
        $suppliers = Supplier::all();
        return view('barang.edit', compact('barang', 'jenis', 'satuan', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, Barang $barang)
    {
        $barang->update($request->validated());
        return redirect()->route('barang.index')->with('success', 'Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang deleted successfully.');
    }
}
