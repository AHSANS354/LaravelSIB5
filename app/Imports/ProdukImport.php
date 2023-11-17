<?php

namespace App\Imports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Produk([
            //
            'kode' => $row[0],
            'nama' => $row[1],
            'harga_beli' => $row[2],
            'harga_jual' => $row[3],
            'stok' => $row[4],
            'min_stok' => $row[5],
            'jenis_produk_id' => $row[6],

        ]);
    }
}
