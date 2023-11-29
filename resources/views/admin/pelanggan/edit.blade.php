@extends('admin.layout.appadmin')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<h2 align="center">Tambah Data Pelanggan</h2>
@foreach ($pelanggan as $pl)
    
<form method="POST" action="{{route('pelanggan.update', $pl->id)}}" class="m-5">
  @csrf
  @method('PUT')
  <div class="form-group row">
    <label for="kode" class="col-4 col-form-label">Kode</label> 
    <div class="col-8">
      <input id="kode" name="kode" placeholder="Input Kode Pelanggan" type="text" class="form-control" value="{{$pl->kode}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="nama" class="col-4 col-form-label">Nama</label> 
    <div class="col-8">
      <input id="nama" name="nama" placeholder="Input Nama Pelanggan" type="text" class="form-control" value="{{$pl->nama}}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Jenis Kelamin</label> 
    <div class="col-8">
      @foreach ($gender as $g)
      @php $cek = ($g === $pl->jk) ? 'checked':''; @endphp
      <div class="custom-control custom-radio custom-control-inline">
        <input name="jk" id="" type="radio" class="custom-control-input" value="{{$g}}" {{$cek}}> 
        <label for="" class="custom-control-label">{{$g}}</label>
      </div>
      @endforeach
    </div>
  </div>
  <div class="form-group row">
    <label for="tmp_lahir" class="col-4 col-form-label">Tempat Lahir</label> 
    <div class="col-8">
      <input id="tmp_lahir" name="tmp_lahir" placeholder="Input Tempat Lahir" type="text" class="form-control" value="{{$pl->tmp_lahir}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label> 
    <div class="col-2">
      <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control" value="{{$pl->tgl_lahir}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-4 col-form-label">Email</label> 
    <div class="col-8">
      <input id="email" name="email" placeholder="Input Email Pelanggan" type="email" class="form-control" value="{{$pl->email}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="kartu_id" class="col-4 col-form-label">Kartu</label>
    <div class="col-2">
      <select id="kartu_id" name="kartu_id" class="custom-select">
        @foreach ($kartu as $k)
        @php $sel = ($k->id == $pl->kartu_id) ? 'selected':''; @endphp
        <option value="{{$k->id}}" {{$sel}}>{{$k->nama}}</option>
        @endforeach 
      </select>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
      <a href="{{url('admin/pelanggan')}}">
        <button name="back" type="button" class="btn btn-secondary">Back</button>
      </a>
    </div>
    
  </div>
</form>
@endforeach
@endsection