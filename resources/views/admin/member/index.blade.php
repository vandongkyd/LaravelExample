@extends("admin.layout.app")

@section('title', 'Danh Sách Thành Viên')

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="box-head">
                        <div class="row">
                            <h3 class="title col-lg-10 col-12 c-grey-900 mB-20">Danh Sách Thành Viên</h3>
                            <div class="col-lg-2 col-12 text-right">
                                <a href="{{route("member.add")}}" role="button"
                                   class="btn btn-primary btn-common text-center">
                                    <span><i class="fa fa-plus"></i> Thêm</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Họ Tên</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Vai Trò</th>
                            <th>Trạng Thái</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->getId() }}</td>
                                <td>
                                    <img width="50px" src="{{ empty($member->getAvatar()) ? asset("asset/images/icon_member.png") :  asset("save_image/". $member->getAvatar()) }}">
                                </td>
                                <td>{{ $member->getFullName() }}</td>
                                <td>{{ $member->getUserName() }}</td>
                                <td>{{ $member->getRole()->getRoleName() }}</td>
                                <td>
                                    <span class="badge status_custom{{ $member->getStatus() }}">
                                        {{ __("messages.member_status.".$member->getStatus()) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-box btn-outline btn-warning {{$member->getId() == Auth::guard('admin')->user()->id ? 'disabled' : '' }}"
                                            @if($member->getId() != Auth::guard('admin')->user()->id) data-toggle="modal"
                                            data-target="#modalNotification" onclick="popupConfirm('{{$member->getId()}}','reset')" @endif>
                                        <i class="fa fa-undo text_white"></i>
                                    </button>

                                    <a href="{{ route('member.edit',['id' => $member->getId()]) }}"
                                       class="btn btn-sm btn-box btn-outline btn-primary">
                                        <i class="fa fa-pencil-square-o text_white"></i>
                                    </a>

                                    <button class="btn btn-sm btn-box btn-outline btn-info {{$member->getId() == Auth::guard('admin')->user()->id ? 'disabled' : '' }}"
                                            @if($member->getId()  != Auth::guard('admin')->user()->id) data-toggle="modal"
                                            data-target="#modalNotification" onclick="popupConfirm('{{ $member->getId() }}','{{ $member->getStatus() != 2 ? 'lock' : 'unlock'}}')" @endif>
                                        <i class="fa {{ $member->getStatus() != 2 ? 'fa-lock' : 'fa-unlock' }} text_white"></i>
                                    </button>
                                    <button class="btn btn-sm btn-box btn-outline btn-danger {{$member->getId() == Auth::guard('admin')->user()->id ? 'disabled' : '' }}"
                                            @if($member->getId()  != Auth::guard('admin')->user()->id)
                                            data-toggle="modal" data-target="#modalNotification" onclick="popupConfirm('{{$member->getId()}}','delete')" @endif>
                                        <i class="fa fa-trash-o text_white"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form role="form" id="f_popup" action="{{route('member.delete.do')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Xóa Thành Viên</h5>
                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="common_id">
                        <p id="messages">Bạn có chắc chắn xóa thành viên này </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-close"></i> <span>Hủy</span>
                        </button>
                        <button type="submit" class="btn btn-outline btn-primary btn-sm" id="btn_popup">
                            <i class="fa fa-trash-o"></i> <span>Xóa</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function popupConfirm(id,mod) {
            if (mod == 'delete'){
                $('#f_popup').attr('action', '{{ route('member.delete.do') }}');
                $('#title').html('Xóa Thành Viên');
                $('#messages').html('Bạn có chắc chắn xóa thành viên này');
                $('#btn_popup').html('<i class="fa fa-trash-o"></i> <span>Xóa</span>');
            }else if (mod == 'lock'){
                $('#f_popup').attr('action', '{{ route('member.lock.do') }}');
                $('#title').html('Khóa Thành Viên');
                $('#messages').html('Bạn có chắc chắn khóa thành viên này');
                $('#btn_popup').html('<i class="fa fa-lock"></i> <span>Khóa</span>');
            } else if (mod == 'unlock'){
                $('#f_popup').attr('action', '{{ route('member.unlock.do') }}');
                $('#title').html('Mở Khóa Thành Viên');
                $('#messages').html('Bạn có chắc chắn mở khóa thành viên này');
                $('#btn_popup').html('<i class="fa fa-unlock"></i> <span>Mở Khóa</span>')
            } else {
                $('#f_popup').attr('action', '{{ route('member.reset.do') }}');
                $('#title').html('Đặt Lại Thành Viên');
                $('#messages').html('Bạn có chắc chắn đặt lại thành viên này');
                $('#btn_popup').html('<i class="fa fa-undo"></i> <span>Đặt Lại</span>')
            }
            $("#common_id").val(id);
        }
    </script>
@endsection
