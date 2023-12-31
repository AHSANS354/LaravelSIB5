<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = [
        'kode',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok',
        'min_stok',
        'jenis_produk_id'
    ];

    public $timestamps = false;

    //relasi one to many 
    public function jenis_produk() {
        return $this->belongsTo(jenis_produk::class);
    }

    //relasi one to one
    // public function gaji(){
    //     return $this->hasOne(gaji::class);
    // }
}
