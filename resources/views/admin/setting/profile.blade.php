@extends("admin.layout.app")

@section('title', 'Thông Tin')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Thông Tin</h3>
                <div class="mT-30">
                    <form action="{{ route("setting.profile.do",["id" =>  $account->getId()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <label class="common-label" for="avatar" id="profile-container">
                                <img id="profileImage" src="{{ empty($account->getAvatar()) ? asset("asset/images/icon_member.png") :  asset("save_image/". $account->getAvatar()) }}"/>
                            </label>
                            <input id="avatar" type="file" name="avatar" accept="image/*">
                            @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="full_name">Họ Tên</label>
                                <input type="text" class="form-control" value="{{ old("full_name", $account->getFullName()) }}"
                                       name="full_name" id="full_name" placeholder="Họ Tên">
                                @error('full_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="phone">Điện Thoại</label>
                                <input type="text" class="form-control" value="{{ old("phone",$account->getPhone()) }}"
                                       name="phone" id="phone" placeholder="Điện Thoại">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="address">Địa Chỉ</label>
                                <textarea class="form-control" placeholder="Địa Chỉ" name="address" id="address">{{ old('address', $account->getAddress()) }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-refresh" aria-hidden="true"></i> Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $(document).ready(function () {
            $("#avatar").change(function() {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

    </script>
@endsection
