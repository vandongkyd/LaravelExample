@extends("admin.layout.app")

@section('title', 'Cập Nhật Sản Phẩm')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Cập Nhật Sản Phẩm</h3>
                <div class="mT-30">
                    <form action="{{ route("product.edit.do",["id" => $product->getId()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="category">Thể Loại</label>
                                <select id="category" class="form-control" name="category">
                                    <option value="">Chọn thể loại</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->getId() }}" @if(old("category", $product->getCategoryId()) == $category->getId()) selected="selected" @endif>{{ $category->getCategoryName() }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_price">Giá</label>
                                <input type="text" class="form-control" value="{{ old("product_price", $product->getProductPrice()) }}"
                                       name="product_price" id="product_price" placeholder="Giá">
                                @error('product_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_name">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" value="{{ old("product_name", $product->getProductName()) }}"
                                       name="product_name" id="product_name" placeholder="Tên Sản Phẩm">
                                @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_quantity">Số Lượng</label>
                                <input type="text" class="form-control" value="{{ old("product_quantity", $product->getProductQuantity()) }}"
                                       name="product_quantity" id="product_quantity" placeholder="Số Lượng">
                                @error('product_quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_status">Trạng Thái</label>
                                <select id="product_status" class="form-control" name="product_status">
                                    <option value="">Chọn trạng thái</option>
                                    @foreach(__("messages.product_status") as $key => $value)
                                        <option value="{{ $key }}" @if(old("product_status", $product->getProductStatus()) == $key) selected="selected" @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('product_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_image">Hình Đại Diện</label>
                                <input type="file" class="dropify form-control" value="{{ old("product_image") }}"
                                       data-default-file="{{ asset('save_image') }}/{{ old('product_image', $product->getProductImage()) }}"
                                       name="product_image" id="product_image" accept="image/*">
                                @error('product_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="common-label" for="filer_input2">Hình Ảnh Khác</label>
                                <input type="file" class="abc" name="files[]" id="filer_input2" multiple="multiple">
                                @if(count($product->getProductImages()) > 0)
                                    <div class="jFiler-items jFiler-row" id="list-Item-file">
                                        <ul class="jFiler-items-list jFiler-items-grid">
                                            @foreach($product->getProductImages() as $productImage)
                                                <li class="jFiler-item" id="Item-file-{{ $productImage->getId() }}">
                                                    <div class="jFiler-item-container">
                                                        <div class="jFiler-item-inner">
                                                            <div class="jFiler-item-thumb">
                                                                <div class="jFiler-item-status"></div>
                                                                <div class="jFiler-item-thumb-overlay">
                                                                    <div class="jFiler-item-info">
                                                                        <div style="display:table-cell;vertical-align: middle;">
                                                                            <span class="jFiler-item-title"><b title="{{ $productImage->getFileName() }}">{{ $productImage->getFileName() }}</b></span>
                                                                            <span class="jFiler-item-others"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="jFiler-item-thumb-image">
                                                                    <img src="{{ asset('save_image') }}/{{ $productImage->getFileName() }}" draggable="false">
                                                                </div>
                                                            </div>
                                                            <div class="jFiler-item-assets jFiler-row">
                                                                <ul class="list-inline pull-left">
                                                                    <li>
                                                                        <div class="jFiler-item-others text-success">
                                                                            <i class="icon-jfi-check-circle"></i>
                                                                            Success
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <ul class="list-inline pull-right">
                                                                    <li><a class="icon-jfi-trash jFiler-item-trash-action btn-remove-img" data-id-file="{{ $productImage->getId() }}">
                                                                            <input type="hidden" class="file-nameImage" value="{{ $productImage->getFileName() }}">
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="common-label" for="summernote">Nội Dung</label>
                                <textarea class="form-control" id="summernote" name="product_content">{{ old("product_content", $product->getProductContent()) }}</textarea>
                                @error('product_content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("product.list") }}"><i class="fa fa-undo" aria-hidden="true"></i> Quay Lại</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-refresh" aria-hidden="true"></i> Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('.btn-remove-img').on('click', function () {
                var r = confirm("Are you sure you want to remove this file?");
                let fileName = $(this).find(".file-nameImage").val();
                let IdFile = $(this).data('id-file');
                const form_data = new FormData();
                form_data.append('file', fileName);
                form_data.append('type', "1");
                if (r == true) {
                    $.ajax({
                        url: "{{ route('common.delete.image') }}",
                        data: form_data,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            let total = "{{ count($product->getProductImages()) }}" - 1;
                            $('#Item-file-'+IdFile).remove();
                            if (total == 0){
                                $('#list-Item-file').remove();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
