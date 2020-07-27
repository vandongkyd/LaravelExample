@extends("admin.layout.app")

@section('title', 'Đổi Mật Khẩu')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Đổi Mật Khẩu</h3>
                <div class="mT-30">
                    <form action="{{ route("setting.changePassword.do",["id" =>  $account->getId()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="password_current">Mật Khẩu Hiện Tại</label>
                                <input type="password" class="form-control" value="{{ old("password_current") }}"
                                       name="password_current" id="password_current" placeholder="Mật Khẩu Hiện Tại">
                                @error('password_current')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="password">Mật Khẩu Mới</label>
                                <input type="password" class="form-control" value="{{ old("password") }}"
                                       name="password" id="password" placeholder="Mật Khẩu Mới">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="password_confirm">Xác Nhận Mật Khẩu</label>
                                <input type="password" class="form-control" value="{{ old("password_confirm") }}"
                                       name="password_confirm" id="password_confirm" placeholder="Xác Nhận Mật Khẩu">
                                @error('password_confirm')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-refresh" aria-hidden="true"></i> Đổi Mật Khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
