@extends('admin_layout')
@section('admin_header')
    <h1>
        Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.product.index') }}">Product</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection
@section('admin_content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title" style="color: red">Cập nhật sản phẩm</h1>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.product.update', ['product_id' => $edit_product->product_id]) }}"
            method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">

                    <div class="form-group col-sm-12">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="product_name"
                            value="{{ $edit_product->product_name }}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="product_image" id="gallery-photo-add-one">
                        <div class="preview-img-one">
                            <img id="remove-one"
                                src="{{ URL::to('/public/uploads/product/' . $edit_product->product_image) }}" alt=""
                                width="150px">
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Hình ảnh chi tiết</label>
                        <input type="file" name="image[]" class="form-control" multiple="multiple" id="gallery-photo-add">
                        <div class="row" id="remove">
                            @foreach ($edit_product->images as $itemImage)
                                <div class="col-md-3">
                                    <img src="{{ URL::to('/public/uploads/product/' . $itemImage->image) }}" alt=""
                                        width="150px">
                                </div>
                            @endforeach
                        </div>
                        <div class="preview-img"></div>
                    </div>

                </div>
                <div class="form-group col-sm-6">
                    <label for="">Chọn màu sắc</label><br>
                    @foreach ($color as $item)
                        <input type="checkbox" class="minimal" name="color_name[]" value="{{ $item->color_id }}" @foreach ($product_color as $pc) {{ $item->color_id == $pc->color_id ? 'checked' : '' }} @endforeach><span> {{ $item->color_name }}</span>
                    @endforeach
                </div>
                <div class="form-group col-sm-6">
                    <label for="">Chọn bộ nhớ</label><br>
                    @foreach ($memory as $item)
                        <input type="checkbox" class="minimal" name="memory_name[]" value="{{ $item->memory_id }}" @foreach ($product_memory as $pm) {{ $item->memory_id == $pm->memory_id ? 'checked' : '' }} @endforeach><span>{{ $item->memory_name }}</span>
                    @endforeach
                </div>
                <div class="form-group col-sm-6">
                    <label for="exampleInputPassword1">Mô tả sản phẩm</label><br>
                    <textarea name="product_desc" id="ckeditor1" cols="50"
                        rows="3">{{ $edit_product->product_desc }}</textarea>
                </div>
                <div class="form-group col-sm-6">
                    <label for="exampleInputPassword1">Mô tả nội dung</label><br>
                    <textarea name="product_content" id="ckeditor2" cols="50"
                        rows="3">{{ $edit_product->product_content }}</textarea>
                </div>
                <div class="form-group col-sm-6">
                    <label>Giá sản phẩm</label>
                    <input type="text" class="form-control" name="product_price"
                        value="{{ $edit_product->product_price }}">
                </div>

                <div class="form-group col-sm-6">
                    <label>Chọn thương hiệu</label>
                    <select name="brand_id" id="" class="form-control">
                        @foreach ($brand_product as $key => $brand)
                            @if ($brand->brand_id == $edit_product->brand_id)
                                <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @else
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label>Tình trạng</label>
                    <select name="product_available" id="" class="form-control">
                        @if ($edit_product->product_available == 0)
                            <option selected value="0">Hết hàng</option>
                            <option  value="1">Có sẵn</option>
                        @else
                            <option value="0">Hết hàng</option>
                            <option selected value="1">Có sẵn</option>
                        @endif
                                
                                
                    </select>
                </div>
                {{-- <div class="form-group col-sm-6 ">
                  <label >Hiển thị</label>
                  <select name="product_status" id="" class="form-control">
                      <option value="0">Ẩn</option>
                      <option value="1">Hiển thị</option>
                  </select>
              </div> --}}
            </div>

    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" name="update_product">Cập nhật sản phẩm</button>
    </div>

    </form>
    </div>
@endsection
