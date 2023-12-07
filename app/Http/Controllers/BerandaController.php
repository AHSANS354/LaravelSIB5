<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class BerandaController extends Controller
{
    //
    public function index(){
        $produk = Produk::take(3)->get(); // Mengambil maksimal 3 produk
        return view('beranda', compact('produk'));
    }
}
