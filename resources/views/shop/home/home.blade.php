@extends('shop.layout.app')

@section('title', 'Trang Chủ')

@section('content')
    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">

            <div class="slider-item" style="background-image: url('{{ asset("asset/images/background.png") }}');">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">Demo</h1>
                            <h2 class="subheading mb-4">Demo</h2>
                            <p><a href="{{ route("shop.product.detail",["id" => 1]) }}" class="btn btn-primary">Xem chi tiết</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">SẢN PHẨM NỔI BẬT</span>
                    <h2 class="mb-4">SẢN PHẨM BÁN CHẠY NHẤT</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($productSelling as $selling)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route("shop.product.detail",["id" => $selling->getId()]) }}" class="img-prod custom-image"><img class="img-fluid" src="{{ asset("save_image/".$selling->getProductImage()) }}" alt="Colorlib Template">
                                <span class="label-badge">10%</span>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route("shop.product.detail",["id" => $selling->getId()]) }}">{{ $selling->getProductName() }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="price-sale">{{ number_format($selling->getProductPrice()) }} đ</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a class="buy-now d-flex justify-content-center align-items-center mx-1" data-id="{{ $selling->getId() }}">
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

    <section class="ftco-section p-0">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">SẢN PHẨM MỚI</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($productNews as $productNew)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route("shop.product.detail",["id" => $productNew->getId()]) }}" class="img-prod custom-image"><img class="img-fluid" src="{{ asset("save_image/".$productNew->getProductImage()) }}" alt="Colorlib Template">
                                <span class="label-badge news">Mới</span>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route("shop.product.detail",["id" => $productNew->getId()]) }}">{{ $productNew->getProductName() }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="price-sale">{{ number_format($productNew->getProductPrice()) }} đ</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <button class="buy-now d-flex justify-content-center align-items-center mx-1" data-id="{{ $productNew->getId() }}">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </button>
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


    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">NHẬN XÉT</span>
                    <h2 class="mb-4">KHÁCH HÀNG HÀI LÒNG</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        @for($i = 0; $i < 5; $i++)
                        <div class="item">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-5" style="background-image: url('{{ asset("asset/shop/images/person_1.jpg") }}')">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                      <i class="icon-quote-left"></i>
                                    </span>
                                </div>
                                <div class="text text-center">
                                    <p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Garreth Smith</p>
                                    <span class="position">Marketing Manager</span>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Miễn phí vận chuyển</h3>
                            <span>Cho đơn hàng trên {{ number_format("200000") }} ₫</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 active d-flex justify-content-center align-items-center mb-2">
                            <span class="fas fa-tools"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Chính sách bảo hành</h3>
                            <span>Một đổi một trong vòng 6 tháng</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Chất lượng cao</h3>
                            <span>Chất lượng sản phẩm</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Hổ trợ</h3>
                            <span>24/7 Hổ trợ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-partner">
        <div class="container">
            <div class="row">
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{ asset("asset/shop/images/partner-1.png") }}" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{ asset("asset/shop/images/partner-1.png") }}images/partner-1.png" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{ asset("asset/shop/images/partner-3.png") }}images/partner-3.png" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{ asset("asset/shop/images/partner-4.png") }}" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{ asset("asset/shop/images/partner-5.png") }}" class="img-fluid" alt="Colorlib Template"></a>
                </div>
            </div>
        </div>
    </section>
@endsection
