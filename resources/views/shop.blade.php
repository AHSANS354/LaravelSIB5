@extends('front.app')
@section('front')
    <!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">

                    @foreach ($produk as $p)
                    <!-- Start Column 1 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" @auth href="{{ route('add.to.cart', $p->id) }}" @endauth>
                            @empty($p->foto)
                            <img src="{{asset('admin/img/no-foto.png')}}" class="img-fluid product-thumbnail">
                            @else
                            <img src="{{asset('admin/img/'.$p->foto)}}" class="img-fluid product-thumbnail">
                            @endempty
							<h3 class="product-title">{{$p->nama}}</h3>
							<strong class="product-price">Rp.{{number_format($p->harga_jual,0,',','.')}}</strong>

							<span class="icon-cross">
                                <img src="{{asset('front/images/cross.svg')}}" class="img-fluid">
							</span>
						</a>
					</div> 
					<!-- End Column 1 -->
                            @endforeach
		      	</div>
		    </div>
		</div>
@endsection