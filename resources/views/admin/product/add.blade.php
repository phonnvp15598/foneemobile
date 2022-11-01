@extends('admin_layout')
@section('admin_header')
    <h1>
        Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.product.index') }}">Product</a></li>
        <li class="active">Add</li>
    </ol>
@endsection
@section('admin_content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title" style="color: red">Thêm sản phẩm</h1>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.product.save') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body ">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}">
                        @error('product_name')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="product_image" id="gallery-photo-add-one">
                        <div class="preview-img-one"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1">Hình ảnh chi tiết</label>
                        <input type="file" multiple="multiple" class="form-control" name="image[]" id="gallery-photo-add">
                        <div class="preview-img"></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Chọn màu sắc</label><br>
                        @foreach ($color as $item)
                            <input type="checkbox" class="minimal" name="color_name[]" value="{{ $item->color_id }}"><span>
                                {{ $item->color_name }}</span>
                        @endforeach
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Chọn bộ nhớ</label><br>
                        @foreach ($memory as $item)
                            <input type="checkbox" class="minimal" name="memory_name[]"
                                value="{{ $item->memory_id }}"><span>{{ $item->memory_name }}</span>
                        @endforeach
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label><br>
                        <textarea name="product_desc" id="ckeditor1" cols="70"
                            rows="5">{{ old('product_desc') }}</textarea>
                        @error('product_desc')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Mô tả nội dung</label><br>
                        <textarea name="product_content" id="ckeditor2" cols="70"
                            rows="5">{{ old('product_content') }}</textarea>
                        @error('product_content')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="product_price" value="{{ old('product_price') }}">
                        @error('product_price')
                            <p class="badge btn-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Chọn thương hiệu</label>
                        <select name="brand_id" id="" class="form-control">
                            @foreach ($brand_product as $key => $value)
                                <option value="{{ $value->brand_id }}">{{ $value->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6 ">
                        <label for="exampleInputEmail1">Nổi bật</label>
                        <select name="product_status" id="" class="form-control">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6 ">
                        <label for="exampleInputEmail1">Tình trạng</label>
                        <select name="product_available" id="" class="form-control">
                            <option value="1">Có sẵn</option>
                            <option value="0">Hết hàng</option>
                        </select>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="add_product">Thêm sản phẩm</button>
            </div>

        </form>
    </div>
@endsection
