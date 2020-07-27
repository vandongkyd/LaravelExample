@extends("admin.layout.app")

@section('title', 'Danh Sách Khách Hàng')

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="box-head">
                        <div class="row">
                            <h3 class="title col-lg-10 col-12 c-grey-900 mB-20">Danh Sách Khách Hàng</h3>
                            <div class="col-lg-2 col-12 text-right">
                                <a href="{{route("customer.add")}}" role="button"
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
                            <th>Email</th>
                            <th>Điện Thoại</th>
                            <th>Trạng Thái</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->getId() }}</td>
                                <td>
                                    <img width="50px" src="{{ empty($customer->getAvatar()) ? asset("asset/images/icon_member.png") : asset("save_image/". $customer->getAvatar()) }}" alt="">
                                </td>
                                <td>{{ $customer->getFullName() }}</td>
                                <td>{{ $customer->getEmail() }}</td>
                                <td>{{ $customer->getPhone() }}</td>
                                <td>
                                    <span class="badge status_custom{{ $customer->getStatus() }}">
                                        {{ __("messages.customer_status.".$customer->getStatus()) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-box btn-outline btn-warning"
                                            data-toggle="modal"
                                            data-target="#modalNotification" onclick="popupConfirm('{{$customer->getId()}}','reset')">
                                        <i class="fa fa-undo text_white"></i>
                                    </button>

                                    <a href="{{ route('customer.edit',['id' => $customer->getId()]) }}"
                                       class="btn btn-sm btn-box btn-outline btn-primary">
                                        <i class="fa fa-pencil-square-o text_white"></i>
                                    </a>

                                    <button class="btn btn-sm btn-box btn-outline btn-info"
                                            data-toggle="modal" data-target="#modalNotification"
                                            onclick="popupConfirm('{{ $customer->getId() }}','{{ $customer->getStatus() != 2 ? 'lock' : 'unlock'}}')">
                                        <i class="fa {{ $customer->getStatus() != 2 ? 'fa-lock' : 'fa-unlock' }} text_white"></i>
                                    </button>
                                    <button class="btn btn-sm btn-box btn-outline btn-danger" data-toggle="modal" data-target="#modalNotification"
                                            onclick="popupConfirm('{{$customer->getId()}}','delete')">
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
            <form role="form" id="f_popup" action="{{route('customer.delete.do')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Xóa Khách Hàng</h5>
                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="common_id">
                        <p id="messages">Bạn có chắc chắn xóa khách hàng này </p>
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
                $('#f_popup').attr('action', '{{ route('customer.delete.do') }}');
                $('#title').html('Xóa Khách Hàng');
                $('#messages').html('Bạn có chắc chắn xóa khách hàng này');
                $('#btn_popup').html('<i class="fa fa-trash-o"></i> <span>Xóa</span>');
            }else if (mod == 'lock'){
                $('#f_popup').attr('action', '{{ route('customer.lock.do') }}');
                $('#title').html('Khóa Khách Hàng');
                $('#messages').html('Bạn có chắc chắn khóa khách hàng này');
                $('#btn_popup').html('<i class="fa fa-lock"></i> <span>Khóa</span>');
            } else if (mod == 'unlock'){
                $('#f_popup').attr('action', '{{ route('customer.unlock.do') }}');
                $('#title').html('Mở Khóa Khách Hàng');
                $('#messages').html('Bạn có chắc chắn mở khóa khách hàng này');
                $('#btn_popup').html('<i class="fa fa-unlock"></i> <span>Mở Khóa</span>')
            } else {
                $('#f_popup').attr('action', '{{ route('customer.reset.do') }}');
                $('#title').html('Đặt Lại Khách Hàng');
                $('#messages').html('Bạn có chắc chắn đặt lại khách hàng này');
                $('#btn_popup').html('<i class="fa fa-undo"></i> <span>Đặt Lại</span>')
            }
            $("#common_id").val(id);
        }
    </script>
@endsection
