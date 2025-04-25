<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $guarded = ['id'];
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
