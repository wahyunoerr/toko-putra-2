<?php

namespace App\Http\Controllers;

use App\Http\Requests\SatuanBarangRequest;
use App\Models\SatuanBarang;
use Illuminate\Http\Request;

class SatuanBarangController extends Controller
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
            $satuanBarangs = SatuanBarang::search($request->q)->paginate(10);
        } else {
            $satuanBarangs = SatuanBarang::latest()->paginate(10);
        }
        return view('barang.satuan.index', compact('satuanBarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SatuanBarangRequest $request)
    {

        SatuanBarang::create($request->validated());

        return redirect()->route('satuan-barang.index')->with('success', 'Satuan Barang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SatuanBarang $satuanBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SatuanBarang $satuanBarang)
    {
        return view('barang.satuan.edit', compact('satuanBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SatuanBarangRequest $request, SatuanBarang $satuanBarang)
    {
        $satuanBarang->update($request->validated());

        return redirect()->route('satuan-barang.index')->with('success', 'Satuan Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SatuanBarang $satuanBarang)
    {
        $satuanBarang->delete();

        return redirect()->route('satuan-barang.index')->with('success', 'Satuan Barang deleted successfully.');
    }
}
