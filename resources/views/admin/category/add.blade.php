@extends("admin.layout.app")

@section('title', 'Thêm Thể Loại')

@section("content")
    <div class="container-fluid">
        <div class="masonry-item">
            <div class="bgc-white p-20 bd"><h3 class="c-grey-900">Thêm Thể Loại</h3>
                <div class="mT-30">
                    <form action="{{ route("category.add.do") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="category_name">Tên Thể Loại</label>
                                <input type="text" class="form-control" value="{{ old("category_name") }}"
                                       name="category_name" id="category_name" placeholder="Tên Thể Loại">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="common-label" for="category_status">Trạng Thái</label>
                                <select id="category_status" class="form-control" name="category_status">
                                    @foreach(__("messages.common_status") as $key => $value)
                                        <option value="{{ $key }}" @if(old("category_status") == $key) selected="selected" @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('category_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <a role="button" class="btn btn-secondary btn-common" href="{{ route("category.list") }}"><i class="fa fa-undo" aria-hidden="true"></i> Quay Lại</a>
                        <button type="submit" class="btn btn-primary btn-common"><i class="fa fa-save" aria-hidden="true"></i> Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
