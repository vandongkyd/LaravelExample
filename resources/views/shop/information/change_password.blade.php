./@extends('shop.layout.app')

@section('title', 'CẬP NHẬT MẬT KHẨU')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset("asset/images/background.png") }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route("home") }}">Trang Chủ</a></span> <span>Quên Mật Khẩu</span></p>
                    <h1 class="mb-0 bread">CẬP NHẬT MẬT KHẨU</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section contact-section bg-light" style="padding: 2em 0">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-12 order-md-last">
                    @if (session('status'))
                        <div class="alert alert-{{ session("status") == "error" ? "danger" : "success" }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('change.password.id.do',["id" => $id]) }}" class="bg-white p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="password_new">Mật Khẩu Mới</label>
                            <input id="password_new" type="password" class="form-control" name="password_new" placeholder="Mật Khẩu Mới">

                            @error('password_new')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Xác Nhận Mật Khẩu</label>
                            <input id="password_confirm" type="password" class="form-control" name="password_confirm" placeholder="Xác Nhận Mật Khẩu">
                            @error('password_confirm')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Cập Nhật" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


