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
    public function index(Request $request)
    {
        $query = Barang::query()->with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $search . '%')
                  ->orWhere('lokasi_gudang', 'like', '%' . $search . '%');
            });
        }


        $barangs = $query->paginate(10);
        $kategoris = Kategori::all();
        
        return view('barang.index', compact('barangs', 'kategoris'));
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
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }


    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer|min:0',
            'kategori' => 'nullable|string',
            'lokasi_gudang' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        try {
            // Soft delete barang
            $barang->delete();
            
            return redirect()->route('barang.index')
                ->with('success', 'Barang berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')
                ->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }
}
