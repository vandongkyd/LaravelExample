@extends("admin.layout.app")

@section('title', 'Danh Sách Thể Loại')

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="box-head">
                        <div class="row">
                            <h3 class="title col-lg-10 col-12 c-grey-900 mB-20">Danh Sách Thể Loại</h3>
                            <div class="col-lg-2 col-12 text-right">
                                <a href="{{route("category.add")}}" role="button"
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
                            <th>Tên Thể Loại</th>
                            <th>Trạng Thái</th>
                            <th>Người Tạo</th>
                            <th>Ngày Tạo</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->getId() }}</td>
                                <td>{{ $category->getCategoryName() }}</td>
                                <td>
                                    <span class="badge status_custom{{ $category->getCategoryStatus() }}">
                                            {{ __("messages.common_status.".$category->getCategoryStatus()) }}
                                    </span>
                                </td>
                                <td>{{ $category->getCreator()->getUserName() }}</td>
                                <td>{{ date('d/m/Y', strtotime($category->getCreated())) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('category.edit',['id' => $category->getId()]) }}"
                                       class="btn btn-sm btn-box btn-outline btn-primary">
                                        <i class="fa fa-pencil-square-o text_white"></i>
                                    </a>
                                    <button class="btn btn-sm btn-box btn-outline btn-danger" data-toggle="modal"
                                            data-target="#modalNotification" onclick="deleteCommon({{$category->getId()}})">
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
            <form role="form" action="{{route('category.delete.do')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa Thể Loại</h5>
                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="common_id">
                        <p>Bạn có chắc chắn xóa thể loại này </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-close"></i> <span>Hủy</span>
                        </button>
                        <button type="submit" class="btn btn-outline btn-primary btn-sm">
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
        function deleteCommon(id) {
            $("#common_id").val(id);
        }
    </script>
@endsection
