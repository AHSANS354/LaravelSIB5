<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Jenis_produk;
use App\Models\Pelanggan;
use App\Models\Kartu;
use DB;

class DashboardController extends Controller
{
    //fungsi index
    public function index()
    {
        $produk = Produk::count();
        $jenis_produk = Jenis_produk::count();
        $pelanggan = Pelanggan::count();
        $kartu = Kartu::count();
        $jenis_kelamin = Pelanggan::select('jk', DB::raw('count(jk) as jumlah'))
        ->groupBy('jk')
        ->get();
        $hitung_harga = DB::table('produk')->select('nama', 'harga_jual')->get();
        return view('admin.dashboard', compact('produk','jenis_produk','pelanggan','kartu','jenis_kelamin','hitung_harga')); //mengarahkan ke file yang ada didalam dashboard admin
    }
}
