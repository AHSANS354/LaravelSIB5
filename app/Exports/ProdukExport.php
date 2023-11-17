<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProdukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.kode','produk.nama','produk.harga_beli','produk.harga_jual','produk.stok','produk.min_stok','jenis_produk.nama as jenis')
        ->get();
        return $produk;
    }
    public function headings(): array
    {
        return ['Kode', 'Nama','Harga Beli', 'Harga Jual','Stok','Min Stok','Jenis Produk'];
    }
}
