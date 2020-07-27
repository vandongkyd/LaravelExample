@extends('shop.layout.app')

@section('title', 'Đăng Ký')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset("asset/images/background.png") }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route("home") }}">Trang Chủ</a></span> <span>Đăng Ký</span></p>
                    <h1 class="mb-0 bread">ĐĂNG KÝ</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section contact-section bg-light" style="padding: 2em 0">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-12 order-md-last d-flex">
                    <form method="POST" action="{{ route('register') }}" class="bg-white p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Họ Tên</label>
                            <input id="full_name" type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" placeholder="Họ Tên" @error('full_name') autofocus @enderror>
                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_name">Tên Đăng Nhập</label>
                            <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Tên Đăng Nhập" @error('user_name') autofocus @enderror>
                            @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Mật Khẩu</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Mật Khẩu">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Xác Nhận Mật Khẩu">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Đăng Ký" class="btn btn-primary py-3 px-5">
                        </div>

                        <div class="form-group row mb-0">
                            <a class="btn btn-link" href="{{ route('login') }}">Đăng Nhập</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
