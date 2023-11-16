@extends('admin.layout.appadmin')
@section('content')


<!-- DataTales Example -->
<div class="card shadow mb-4">
                        <h1 class="h1 m-4 d-flex justify-content-center">Pelanggan</h1>
                        <div class="card-header py-3">
                            <a href="{{route('pelanggan.create')}}"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Email</th>
                                            <th>Kartu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Email</th>
                                            <th>Kartu</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($pelanggan as $k)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$k->kode}}</td>
                                            <td>{{$k->nama}}</td>
                                            <td>{{$k->jk}}</td>
                                            <td>{{$k->tmp_lahir}}</td>
                                            <td>{{$k->tgl_lahir}}</td>
                                            <td>{{$k->email}}</td>
                                            <td>{{$k->kartu->nama}}</td>
                                            <td>
                                                <a href="{{ route('pelanggan.edit', $k->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('pelanggan.destroy', $k->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection