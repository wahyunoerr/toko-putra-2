<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
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
            $jenisBarangs = JenisBarang::search($request->q)->paginate(10);
        } else {
            $jenisBarangs = JenisBarang::latest()->paginate(10);
        }

        return view('barang.jenis.index', compact('jenisBarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisBarangRequest $request)
    {
        JenisBarang::create($request->validated());
        return redirect()->route('jenis-barang.index')->with('success', 'Jenis Barang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisBarang $jenisBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisBarang $jenisBarang)
    {
        return view('barang.jenis.edit', compact('jenisBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisBarangRequest $request, JenisBarang $jenisBarang)
    {
        $jenisBarang->update($request->validated());
        return redirect()->route('jenis-barang.index')->with('success', 'Jenis Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisBarang $jenisBarang)
    {
        $jenisBarang->delete();
        return redirect()->route('jenis-barang.index')->with('success', 'Jenis Barang deleted successfully.');
    }
}
