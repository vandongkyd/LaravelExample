@extends("admin.layout.app")

@section('title', 'Cập Nhật Thành Viên')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Cập Nhật Thành Viên</h3>
                <div class="mT-30">
                    <form action="{{ route("member.edit.do",["id" => $member->getId()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="full_name">Họ Tên</label>
                                <input type="text" class="form-control" value="{{ old("full_name", $member->getFullName()) }}"
                                       name="full_name" id="full_name" placeholder="Họ Tên">
                                @error('full_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="user_name">Tên Đăng Nhập</label>
                                <input type="text" class="form-control" value="{{ old("user_name",$member->getUserName()) }}" readonly
                                       name="user_name" id="user_name" placeholder="Tên Đăng Nhập">
                                @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="phone">Điện Thoại</label>
                                <input type="text" class="form-control" value="{{ old("phone",$member->getPhone()) }}"
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
                                        <option value="{{ $role->getId() }}" @if(old("role",$member->getRoleId()) == $role->getId()) selected="selected" @endif>{{ $role->getRoleName() }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="status">Trạng Thái</label>
                                <select id="status" class="form-control" name="status">
                                    @foreach(__("messages.member_status") as $key => $value)
                                        <option value="{{ $key }}" @if(old("status",$member->getStatus()) == $key) selected="selected" @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("member.list") }}"><i class="fa fa-undo" aria-hidden="true"></i> Quay Lại</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-refresh" aria-hidden="true"></i> Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
