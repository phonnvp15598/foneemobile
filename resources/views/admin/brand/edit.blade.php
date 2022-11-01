@extends('admin_layout')
@section('admin_header')
    <h1>
        Brand
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.brand.index') }}">Brand</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection
@section('admin_content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title" style="color: red">Cập nhật thương hiệu</h1>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.brand.update', ['brand_id' => $edit_brand->brand_id]) }}" method="POST">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name"
                        value="{{ $edit_brand->brand_name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả danh mục</label><br>
                    <textarea name="brand_desc" id="" cols="100" rows="3">{{ $edit_brand->brand_desc }}</textarea>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="update_brand">Cập nhật danh mục</button>
            </div>

        </form>
    </div>
@endsection
