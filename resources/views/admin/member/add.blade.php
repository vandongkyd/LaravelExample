@extends("admin.layout.app")

@section('title', 'Thêm Thành Viên')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Thêm Thành Viên</h3>
                <div class="mT-30">
                    <form action="{{ route("member.add.do") }}" method="POST" enctype="multipart/form-data">
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
                                <label class="common-label" for="role">Vai Trò</label>
                                <select id="role" class="form-control" name="role">
                                    <option value="">Chọn vai trò</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->getId() }}" @if(old("role") == $role->getId()) selected="selected" @endif>{{ $role->getRoleName() }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("member.list") }}"><i class="fa fa-undo" aria-hidden="true"></i> Quay Lại</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save" aria-hidden="true"></i> Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
