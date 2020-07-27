@extends('shop.layout.app')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset("asset/images/background.png") }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route("home") }}">Trang Chủ</a></span> <span>Danh Sách Sản Phẩm</span></p>
                    <h1 class="mb-0 bread">DANH SÁCH SẢN PHẨM</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="{{ route("shop.product.detail",["id" => $product->getId()]) }}" class="img-prod custom-image">
                            <img class="img-fluid" src="{{ asset("save_image/".$product->getProductImage()) }}" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="{{ route("shop.product.detail",["id" => $product->getId()]) }}">{{ $product->getProductName() }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price">
                                        <span class="price-sale">{{ number_format($product->getProductPrice()) }} đ</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>

{{--                                    @if(Auth::check())--}}
{{--                                        <button class="btn btn-outline btn-cart btn_cart_active" data-id="{{ $product->getId() }}"><i class="fa fa-shopping-cart"></i> Thêm giỏ hàng</button>--}}
{{--                                    @else--}}
{{--                                        <a class="btn btn-outline btn-cart" href="{{ route('login') }}"><i class="fa fa-shopping-cart"></i> Thêm giỏ hàng</a>--}}
{{--                                    @endif--}}
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
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
