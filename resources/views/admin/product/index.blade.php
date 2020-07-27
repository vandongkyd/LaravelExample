@extends("admin.layout.app")

@section('title', 'Danh Sách Sản Phẩm')

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="box-head">
                        <div class="row">
                            <h3 class="title col-lg-10 col-12 c-grey-900 mB-20">Danh Sách Sản Phẩm</h3>
                            <div class="col-lg-2 col-12 text-right">
                                <a href="{{route("product.add")}}" role="button"
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
                            <th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Trạng Thái</th>
                            <th>Người Tạo</th>
                            <th>Ngày Tạo</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->getId() }}</td>
                                <td>
                                    <img width="80px" src="{{ asset("save_image/".$product->getProductImage() )}}" alt="">
                                </td>
                                <td>{{ $product->getProductName() }}</td>
                                <td>{{ number_format($product->getProductPrice()) }}</td>
                                <td>{{ $product->getProductQuantity() }}</td>
                                <td>
                                 <span class="badge status_custom{{ $product->getProductStatus() }}">
                                        {{ __("messages.product_status.".$product->getProductStatus()) }}
                                    </span>
                                </td>
                                <td>{{ !empty($product->getCreatorId()) ? $product->getCreator()->user_name : "" }}</td>
                                <td>{{ date('d/m/Y', strtotime($product->getCreated())) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('product.edit',['id' => $product->getId()]) }}"
                                       class="btn btn-sm btn-box btn-outline btn-primary">
                                        <i class="fa fa-pencil-square-o text_white"></i>
                                    </a>
                                    <button class="btn btn-sm btn-box btn-outline btn-danger" data-toggle="modal"
                                            data-target="#modalNotification" onclick="deleteCommon({{$product->getId()}})">
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
            <form role="form" action="{{route('product.delete.do')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa Sản Phẩm</h5>
                        <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="common_id">
                        <p>Bạn có chắc chắn xóa sản phẩm này </p>
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
