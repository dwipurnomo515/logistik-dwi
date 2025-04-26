<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangKeluar::with(['barang' => function($q) {
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
            $query->whereDate('tanggal_keluar', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_keluar', '<=', $request->end_date);
        }

        $sortField = $request->get('sort', 'tanggal_keluar');
        $sortDirection = $request->get('direction', 'desc');
        
        $allowedSortFields = ['kode_barang', 'nama_barang', 'quantity', 'tanggal_keluar'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'tanggal_keluar';
        }

        if ($sortField == 'kode_barang' || $sortField == 'nama_barang') {
            $query->join('barangs', 'barang_keluars.barang_id', '=', 'barangs.id')
                  ->orderBy("barangs.{$sortField}", $sortDirection)
                  ->select('barang_keluars.*');
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        $barangKeluar = $query->paginate(10)->withQueryString();

        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barang = Barang::whereNull('deleted_at')->get(); // Only active barang
        return view('barang_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'destination' => 'required',
            'tanggal_keluar' => 'required|date',
        ]);

        $barang = Barang::find($request->barang_id);
        if ($barang->stok < $request->quantity) {
            return back()->with('error', 'Stok barang tidak mencukupi.');
        }

        BarangKeluar::create($request->all());

        $barang->stok -= $request->quantity;
        $barang->save();

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
