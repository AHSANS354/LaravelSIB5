<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Jenis_produk;
use App\Models\Produk;
use Alert;
use PDF;
use App\Exports\produkExport;
use App\Imports\ProdukImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jenis_produk = DB::table('jenis_produk')->get();
        return view('admin.produk.create', compact('jenis_produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kode' => 'required|unique:produk|max:10',
            'nama' => 'required|max:45',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'min_stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,png,svg|max:2048',
            'deskripsi' => 'nullable|min:10',
            'jenis_produk_id' => 'required|numeric',
        ],
        [
            'kode.required'=>'Kode produk wajib diisi!',
            'kode.unique'=>'Kode sudah ada, silahkan tambah yang baru',
            'kode.max'=>'Maksimal 10 karakter',
            'nama.required'=>'Nama produk wajib diisi!',
            'nama.max'=>'Maximal 45 Karakter',
            'harga_beli.required'=>'Harga beli wajib diisi!',
            'harga_beli.numeric'=>'Harus angka',
            'harga_jual.required'=>'Harga jual wajib diisi!',
            'harga_jual.numeric'=>'Harus angka',
            'stok.required'=>'Stok wajib diisi!',
            'stok.numeric'=>'Harus Angka',
            'min_stok.required'=>'Minimum stok wajib diisi!',
            'min_stok.numeric'=>'Harus Angka',
            'foto.image'=>'File harus berupa gambar',
            'foto.mimes'=>'Format file harus JPG/JPEG/PNG/SVG',
            'foto.max'=>'Ukuran maksimal 2MB',
            'deskripsi.min'=>'Deskripsi minimal 10 karakter',
            'jenis_produk_id.required'=>'Jenis Produk Wajib Diisi!',
            'jenis_produk_id.numeric'=>'Silahkan pilih dari daftar',
        ]
    );


        if(!empty($request->foto)){
            $fillName = 'foto-'.uniqid().'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/img'), $fillName);
        }else{
            $fillName = '';
        }

        DB::table('produk')->insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_beli'=>$request->harga_beli,
            'harga_jual'=>$request->harga_jual,
            'stok'=>$request->stok,
            'min_stok'=>$request->min_stok,
            'foto'=>$fillName,
            'deskripsi'=>$request->deskripsi,
            'jenis_produk_id'=>$request->jenis_produk_id,
        ]);
        return redirect('admin/produk')->with('toast_success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->get();
        return view('admin.produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $produk = Produk::all()->where('id', $id);
        $jenis_produk = Jenis_produk::all();
        return view('admin.produk.edit', compact('produk','jenis_produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'kode' => 'required|max:10',
            'nama' => 'required|max:45',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'min_stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,png,svg|max:2048',
            'deskripsi' => 'nullable|min:10',
            'jenis_produk_id' => 'required|numeric',
        ],
        [
            'kode.required'=>'Kode produk wajib diisi!',
            'kode.max'=>'Maksimal 10 karakter',
            'nama.required'=>'Nama produk wajib diisi!',
            'nama.max'=>'Maximal 45 Karakter',
            'harga_beli.required'=>'Harga beli wajib diisi!',
            'harga_beli.numeric'=>'Harus angka',
            'harga_jual.required'=>'Harga jual wajib diisi!',
            'harga_jual.numeric'=>'Harus angka',
            'stok.required'=>'Stok wajib diisi!',
            'stok.numeric'=>'Harus Angka',
            'min_stok.required'=>'Minimum stok wajib diisi!',
            'min_stok.numeric'=>'Harus Angka',
            'foto.image'=>'File harus berupa gambar',
            'foto.mimes'=>'Format file harus JPG/JPEG/PNG/SVG',
            'foto.max'=>'Ukuran maksimal 2MB',
            'deskripsi.min'=>'Deskripsi minimal 10 karakter',
            'jenis_produk_id.required'=>'Jenis Produk Wajib Diisi!',
            'jenis_produk_id.numeric'=>'Silahkan pilih dari daftar',
        ]
    );

        $produk = DB::table('produk')->where('id', $id)->first();
        
        $namaFotolama = $produk->foto;

        if(!empty($request->foto)){
            //menghapus foto lama
            if(!empty($namaFotolama)) unlink('admin/img'.$namaFotolama);
            //menambahkan foto baru
            $fillName = 'foto-'.uniqid().'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/img'), $fillName);
        }else{
            $fillName = '';
        }
        


        DB::table('produk')->where('id', $request->id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_beli'=>$request->harga_beli,
            'harga_jual'=>$request->harga_jual,
            'stok'=>$request->stok,
            'min_stok'=>$request->min_stok,
            'foto'=>$fillName,
            'deskripsi'=>$request->deskripsi,
            'jenis_produk_id'=>$request->jenis_produk_id,
        ]);
        return redirect('admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produk = Produk::find($id);
        $produk->delete();
        return redirect('/admin/produk')->with('toast_success', 'Produk berhasil dihapus!');
    }

    //export pdf DOM
    public function exportPdf()
    {
        $data = [
            'title'=>'Welcome to export PDF',
            'date'=>date("Y-m-d"),
        ];
        $pdf = PDF::loadView('admin.produk.myPdf', $data);
        return $pdf->download('invoice.pdf');
    }

    public function produkPDF()
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();
        $pdf = PDF ::loadView('admin.produk.produkPDF', ['produk'=>$produk])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function produkExport(string $id)
    {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->get();
        $pdf = PDF::loadView('admin.produk.produkExport', ['produk'=>$produk]);
        return $pdf->stream();
    }

    public function exportExcel()
    {
        return Excel::download(new produkExport, 'produk.xlsx');
    }

    public function importExcel(Request $request)
{   
    // Mengambil file dari request
    $file = $request->file('file');   
    // Menghasilkan nama unik untuk file
    $nama_file = rand() . $file->getClientOriginalName();
    // Memindahkan file ke direktori public/excel dengan nama unik
    $file->move(public_path('/excel'), $nama_file);
    // Mengimpor data dari file Excel menggunakan kelas ProdukImport
    Excel::import(new ProdukImport, public_path('/excel') . '/' . $nama_file);
    // Mengarahkan pengguna ke halaman /admin/produk dengan pesan sukses
    return redirect('/admin/produk')->with('success', 'Berhasil mengimpor data!');
}

}
