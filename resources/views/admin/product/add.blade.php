@extends("admin.layout.app")

@section('title', 'Thêm Sản Phẩm')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Thêm Sản Phẩm</h3>
                <div class="mT-30">
                    <form action="{{ route("product.add.do") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="category">Thể Loại</label>
                                <select id="category" class="form-control" name="category">
                                    <option value="">Chọn thể loại</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->getId() }}" @if(old("category") == $category->getId()) selected="selected" @endif>{{ $category->getCategoryName() }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_price">Giá</label>
                                <input type="text" class="form-control" value="{{ old("product_price") }}"
                                       name="product_price" id="product_price" placeholder="Giá">
                                @error('product_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_name">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" value="{{ old("product_name") }}"
                                       name="product_name" id="product_name" placeholder="Tên Sản Phẩm">
                                @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="common-label" for="product_quantity">Số Lượng</label>
                                <input type="text" class="form-control" value="{{ old("product_quantity") }}"
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
                                        <option value="{{ $key }}" @if(old("product_status") == $key) selected="selected" @endif>{{ $value }}</option>
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
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="common-label" for="summernote">Nội Dung</label>
                                <textarea class="form-control" id="summernote" name="product_content">{{ old("product_content") }}</textarea>
                                @error('product_content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("product.list") }}"><i class="fa fa-undo" aria-hidden="true"></i> Quay Lại</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save" aria-hidden="true"></i> Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
