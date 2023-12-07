<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use DB;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //
    public function index()
    {
        //
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();
        return new ProdukResource(true, 'Data Produk', $produk);
    }

    public function show(string $id)
    {
        //
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->get();
        return new ProdukResource(true, 'Data Produk', $produk);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'kode' => 'required|unique:produk|max:10',
            'nama' => 'required|max:45',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'min_stok' => 'required|numeric',
            'deskripsi' => 'nullable|min:10',
            'jenis_produk_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),442);
        }

        DB::table('produk')->insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_beli'=>$request->harga_beli,
            'harga_jual'=>$request->harga_jual,
            'stok'=>$request->stok,
            'min_stok'=>$request->min_stok,
            'foto'=>$request->foto,
            'deskripsi'=>$request->deskripsi,
            'jenis_produk_id'=>$request->jenis_produk_id,
        ]);
        return new ProdukResource(true, 'Data Produk Berhasil ditambahkan!', 'produk');
    }

    public function edit(string $id)
    {
        //
        $produk = Produk::all()->where('id', $id);
        $jenis_produk = Jenis_produk::all();
        return view('admin.produk.edit', compact('produk','jenis_produk'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'kode' => 'required|max:10',
            'nama' => 'required|max:45',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'min_stok' => 'required|numeric',
            'deskripsi' => 'nullable|min:10',
            'jenis_produk_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),442);
        }

        $produk = Produk::whereId($id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_beli'=>$request->harga_beli,
            'harga_jual'=>$request->harga_jual,
            'stok'=>$request->stok,
            'min_stok'=>$request->min_stok,
            'foto'=>$request->foto,
            'deskripsi'=>$request->deskripsi,
            'jenis_produk_id'=>$request->jenis_produk_id,
        ]);

        return new ProdukResource(true, 'Berhasil mengubah data!', $produk);
    }

    public function destroy(string $id)
    {
        //
        $produk = Produk::find($id);
        $produk->delete();
        return new ProdukResource(true, 'Data berhasil dihapus!', $produk);
    }
}
