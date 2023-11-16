@extends('admin.layout.appadmin')
@section('content')
    @foreach ($produk as $p)
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                @empty($p->foto)
                <div class="col-md-6 p-5"><img class="card-img-top mb-5 mb-md-0" src="{{asset('admin/img/no-foto.png')}}" alt="..." /></div>
                @else
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('admin/img/'.$p->foto)}}" alt="..." /></div>
                @endempty
                <div class="col-md-6">
                    <div class="small mb-1">{{$p->kode}}</div>
                    <h1 class="display-5 fw-bolder">{{$p->nama}}</h1>
                    <div class="fs-5 mb-5 gap-4 d-flex">
                        <!-- <span class="text-decoration-line-through">Rp.5.000.000</span> -->
                        <span>Rp.{{number_format($p->harga_jual,0,",",".")}}</span>
                    </div>
                    <p class="lead">{{$p->deskripsi}}</p>
                    <div class="">
                        <a href="{{url('admin/produk')}}">
                            <button type="button" class="btn btn-primary">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
@endsection