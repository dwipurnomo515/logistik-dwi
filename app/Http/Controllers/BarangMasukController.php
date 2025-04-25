<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('barang')->latest()->get();
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('barang_masuk.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'origin' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        BarangMasuk::create($request->all());

        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->quantity;
        $barang->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
