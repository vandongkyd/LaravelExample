@extends("admin.layout.app")

@section('title', 'Thêm Khách Hàng')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Thêm Khách Hàng</h3>
                <div class="mT-30">
                    <form action="{{ route("customer.add.do") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="full_name">Họ Tên</label>
                                <input type="text" class="form-control" value="{{ old("full_name") }}"
                                       name="full_name" id="full_name" placeholder="Họ Tên">
                                @error('full_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="user_name">Tên Đăng Nhập</label>
                                <input type="text" class="form-control" value="{{ old("user_name") }}"
                                       name="user_name" id="user_name" placeholder="Tên Đăng Nhập">
                                @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="phone">Điện Thoại</label>
                                <input type="text" class="form-control" value="{{ old("phone") }}"
                                       name="phone" id="phone" placeholder="Điện Thoại">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="email">Email</label>
                                <input type="text" class="form-control" value="{{ old("email") }}"
                                       name="email" id="email" placeholder="Email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="birthday">Ngày Sinh</label>
                                <input type="date" class="form-control" value="{{ old("birthday") }}"
                                       name="birthday" id="birthday">
                                @error('birthday')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="store">Giới Tính</label>
                                <select id="sex" class="form-control" name="sex">
                                    <option value="">Chọn giới tính</option>
                                    @foreach(__("messages.list_sex") as $key => $value)
                                        <option value="{{ $key }}" @if(old("sex") == $key) selected="selected" @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('sex')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("customer.list") }}"><i class="fa fa-undo" aria-hidden="true"></i> Quay Lại</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save" aria-hidden="true"></i> Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
