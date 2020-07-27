@extends('shop.layout.app')

@section('title', 'Đăng Nhập')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset("asset/images/background.png") }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route("home") }}">Trang Chủ</a></span> <span>Đăng Nhập</span></p>
                    <h1 class="mb-0 bread">ĐĂNG NHẬP</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section contact-section bg-light" style="padding: 2em 0">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-12 order-md-last d-flex">
                    <form method="POST" action="{{ route('login') }}" class="bg-white p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="user_name">Tên Đăng Nhập</label>
                            <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Tên Đăng Nhập">
                            @error('user_name')
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                   Ghi Nhớ Mật Khẩu
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Đăng Nhập" class="btn btn-primary py-3 px-5">
                        </div>

                        <div class="form-group row mb-0">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Quên Mật Khẩu?
                                </a>
                            @endif
                            <a class="btn btn-link" href="{{ route('register') }}">Tạo Tài Khoản</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
