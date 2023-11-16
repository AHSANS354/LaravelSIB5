@extends('admin.layout.appadmin')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Tambah Data Produk</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@foreach ($produk as $pr)
    
<form method="POST" action="{{url('admin/produk/update/'.$pr->id)}}" enctype="multipart/form-data" class="m-5">
    @csrf
    <div class="form-group row">
        <label for="text" class="col-4 col-form-label">Kode</label>
        <div class="col-8">
            <input id="text" name="kode" type="text" class="form-control @error('kode') is-invalid @enderror" value="{{$pr->kode}}">
            @error('kode')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-4 col-form-label">Nama</label>
        <div class="col-8">
            <input id="text" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{$pr->nama}}">
            @error('nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="text1" class="col-4 col-form-label">Harga Beli</label>
        <div class="col-8">
            <input id="text1" name="harga_beli" type="text" class="form-control" value="{{$pr->harga_beli}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="text2" class="col-4 col-form-label">Harga Jual</label>
        <div class="col-8">
            <input id="text2" name="harga_jual" type="text" class="form-control" value="{{$pr->harga_jual}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="text3" class="col-4 col-form-label">Stok</label>
        <div class="col-8">
            <input id="text3" name="stok" type="text" class="form-control" value="{{$pr->stok}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="text4" class="col-4 col-form-label">Minimal Stok</label>
        <div class="col-8">
            <input id="text4" name="min_stok" type="text" class="form-control" value="{{$pr->min_stok}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="text4" class="col-4 col-form-label">Foto</label>
        <div class="col-8">
            <input id="text4" name="foto" type="file" class="form-control">
            @if (!empty($pr->foto))
                <img src="{{asset('admin/img/'.$pr->foto)}}" alt="" width="200rem">
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label> 
        <div class="col-8">
          <textarea id="deskripsi" name="deskripsi" cols="40" rows="5" class="form-control">{{$pr->deskripsi}}</textarea>
        </div>
      </div> 
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Jenis Produk</label>
        <div class="col-8">
            <select id="select" name="jenis_produk_id" class="custom-select">
                @foreach ($jenis_produk as $jp)
                @php $sel = ($jp->id == $pr->jenis_produk_id) ? 'selected':''; @endphp
                <option value="{{$jp->id}}" {{$sel}}>{{$jp->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            <a href="{{url('admin/produk')}}">
                <button type="button" class="btn btn-secondary">Back</button>
            </a>
        </div>
    </div>
</form>
@endforeach
@endsection