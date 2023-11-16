@extends('admin.layout.appadmin')
@section('content')


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <h1 class="p-3 top" align="center">Jenis Produk</h1>
    <div class="card-header py-3">
                            <a href="{{url('admin/jenis_produk/create')}}"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($jenis_produk as $jenis)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$jenis->nama}}</td>
                                            <td class="">
                                                <a href="{{url('/admin/jenis_produk/show/'.$jenis->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{url('/admin/jenis_produk/edit/'.$jenis->id)}}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$jenis->id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
  
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$jenis->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin menghapus {{$jenis->nama}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <a href="{{url('/admin/jenis_produk/delete/'.$jenis->id)}}" type="button" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection