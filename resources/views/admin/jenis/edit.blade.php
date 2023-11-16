@extends('admin.layout.appadmin')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 align="center">Tambah Data Jenis Produk</h1>
@foreach ($jenis_produk as $jenis)
    
<form method="POST" action="{{url('admin/jenis_produk/update/'.$jenis->id)}}" class="m-5 p-5">
    @csrf
    <div class="form-group row">
        <label for="nama" class="col-4 col-form-label">Nama</label> 
        <div class="col-8">
            <input id="nama" name="nama" placeholder="Input Nama jenis produk" type="text" class="form-control" value="{{$jenis->nama}}">
        </div>
    </div> 
    @endforeach
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection