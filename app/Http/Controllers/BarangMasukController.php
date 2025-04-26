<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangMasuk::with(['barang' => function($q) {
            $q->withTrashed(); 
        }]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('barang', function($q) use ($search) {
                $q->withTrashed()
                  ->where('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_masuk', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_masuk', '<=', $request->end_date);
        }

        $sortField = $request->get('sort', 'tanggal_masuk');
        $sortDirection = $request->get('direction', 'desc');
        
        $allowedSortFields = ['kode_barang', 'nama_barang', 'quantity', 'tanggal_masuk'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'tanggal_masuk';
        }

        if ($sortField == 'kode_barang' || $sortField == 'nama_barang') {
            $query->join('barangs', 'barang_masuks.barang_id', '=', 'barangs.id')
                  ->orderBy("barangs.{$sortField}", $sortDirection)
                  ->select('barang_masuks.*');
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        $barangMasuk = $query->paginate(10)->withQueryString();

        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $barang = Barang::whereNull('deleted_at')->get(); 
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
