@extends('admin.layout.appadmin')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
                        <h1 class="m-3" align="center">Produk</h1>
                        <div class="card-header py-3">
                            <a href="{{url('admin/produk/create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a>
                            <a href="{{url('admin/produk/produkPDF')}}" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> PDF</a>
                            <a href="{{url('admin/produk/exportExcel')}}" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Excel</a>
                            <!-- Tombol memicu modal untuk impor -->
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#importModal">
                                <i class="fas fa-file-upload"></i> Upload
                            </button>
                        
                            {{-- Modal untuk impor --}}
                            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Impor Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Tambahkan formulir impor atau konten Anda di sini -->
                                            <form method="post" action="{{url('/admin/produk/importExcel')}}" enctype="multipart/form-data">
                                                @csrf
                                            <input type="file" name="file">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <!-- Tambahkan tombol kirim impor Anda di sini -->
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- End modal untuk impor --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga Jual</th>
                                            <th>Harga Beli</th>
                                            <th>Stok</th>
                                            <th>Min Stok</th>
                                            <th>Jenis Produk</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga Jual</th>
                                            <th>Harga Beli</th>
                                            <th>Stok</th>
                                            <th>Min Stok</th>
                                            <th>Jenis Produk</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($produk as $k)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$k->kode}}</td>
                                            <td class="text-truncate">{{$k->nama}}</td>
                                            <td>{{$k->harga_jual}}</td>
                                            <td>{{$k->harga_beli}}</td>
                                            <td>{{$k->stok}}</td>
                                            <td>{{$k->min_stok}}</td>
                                            <td>{{$k->jenis}}</td>
                                            <td class="text-center">
                                                <a href="{{url('admin/produk/show/'.$k->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{url('admin/produk/edit/'.$k->id)}}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{url('admin/produk/exportdtPDF/'.$k->id)}}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$k->id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
  
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$k->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin menghapus {{$k->nama}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <a href="{{url('/admin/produk/delete/'.$k->id)}}" type="button" class="btn btn-danger">Delete</a>
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