@extends('shop.layout.app')

@section('title', 'Thông Tin Sản Phẩm')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset("asset/images/background.png") }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2">
                            <a href="{{ route("home") }}">Trang chủ</a></span> <span class="mr-2">
                            <a href="{{ route("shop.product.list") }}">Sản phẩm</a></span> <span>Thông tin sản phẩm</span>
                    </p>
                    <h1 class="mb-0 bread">THÔNG TIN SẢN PHẨM</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('save_image') }}/{{ $product->getProductImage() }}" class="image-popup image-show active" id="pic-0">
                        <img src="{{ asset('save_image') }}/{{ $product->getProductImage() }}" class="img-fluid" alt="Colorlib Template">
                    </a>
                    @if(count($product->getProductImages()) > 0)
                        @foreach($product->getProductImages() as $productImage)
                            <a href="{{ asset('save_image') }}/{{ $productImage->getFileName() }}" class="image-popup image-show" id="pic-{{ $productImage->getId() }}">
                                <img src="{{ asset('save_image') }}/{{ $productImage->getFileName() }}" class="img-fluid" alt="Colorlib Template">
                            </a>
                        @endforeach
                    @endif

                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a class="image-choice" data-target="#pic-0" data-toggle="tab"><img src="{{ asset('save_image') }}/{{ $product->getProductImage() }}" alt=""/></a></li>
                        @if(count($product->getProductImages()) > 0)
                            @foreach($product->getProductImages() as $productImage)
                                <li><a class="image-choice" data-target="#pic-{{ $productImage->getId() }}" data-toggle="tab"><img src="{{ asset('save_image') }}/{{ $productImage->getFileName() }}" alt=""/></a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->getProductName() }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">{{ $product->getProductRating() }}</a>
                            @for ($i = 0; $i < 5; ++$i)
                                <span class="ion-ios-star{{ $product->getProductRating() <= $i ? '-outline' : '' }}"></span>
                            @endfor
                        </p>
                        <p class="text-left mr-4">
                            <p class="mr-2" style="color: #000;">{{ $product->getProductSelling() }} <span style="color: #bbb;">Đánh giá</span></p>
                        </p>
                        <p class="text-left">
                            <p class="mr-2" style="color: #000;">{{ $product->getProductSelling() }} <span style="color: #bbb;">Đã bán</span></p>
                        </p>
                    </div>
                    <p class="price">
                        <span class="price-sale">{{ number_format($product->getProductPrice()) }} đ</span>
                    </p>

                    <div class="row mt-4">
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
                        </div>
                        <div class="w-100"></div>
                    </div>
                    <p><a href="cart.html" class="btn btn-black py-3 px-5">Thêm Giỏ Hàng</a></p>
                    <p><a href="cart.html" class="btn btn-danger py-3 px-5">Yêu Thích</a></p>
                </div>
            </div>
            <div class="row">
                {!! $product->getProductContent() !!}
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">SẢN PHẨM</span>
                    <h2 class="mb-4">Những Sản Phẩm Liên Quan</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($productRelated as $related)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route("shop.product.detail",["id" => $related->getId()]) }}" class="img-prod custom-image"><img class="img-fluid" src="{{ asset("save_image/".$related->getProductImage()) }}" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route("shop.product.detail",["id" => $related->getId()]) }}">{{ $related->getProductName() }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="price-sale">{{ number_format($related->getProductPrice()) }} đ</span>

                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
