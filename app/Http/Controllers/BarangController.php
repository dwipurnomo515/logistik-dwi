<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'nullable|string',
            'lokasi_gudang' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'kode_barang',
            'nama_barang',
            'stok',
            'kategori_id',
            'lokasi_gudang',
            'deskripsi'
        ]);
        $Pathfoto = null;
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $Pathfoto = $request->file('foto')->store('barang', 'public');
        }


        Barang::create([
            ...$data,
            'foto' => $Pathfoto,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }


    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer|min:0',
            'kategori' => 'nullable|string',
            'lokasi_gudang' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto_barang', $filename);
            $data['foto'] = $filename;
        }

        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
