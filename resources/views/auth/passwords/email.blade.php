@extends('shop.layout.app')

@section('title', 'Quên Mật Khẩu')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset("asset/images/background.png") }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route("home") }}">Trang Chủ</a></span> <span>Quên Mật Khẩu</span></p>
                    <h1 class="mb-0 bread">QUÊN MẬT KHẨU</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section contact-section bg-light" style="padding: 2em 0">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-12 order-md-last">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" class="bg-white p-5 contact-form">
                        @csrf
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
                            <input type="submit" value="Cấp Lại" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


