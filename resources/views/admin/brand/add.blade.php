@extends('admin_layout')
@section('admin_header')
    <h1>
        Brand
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.brand.index') }}">Brand</a></li>
        <li class="active">Add</li>
    </ol>
@endsection
@section('admin_content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title" style="color: red">Thêm thương hiệu</h1>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.brand.save') }}" method="POST">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả thương hiệu</label><br>
                    <textarea name="brand_desc" id="" cols="100" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hiển thị</label>
                    <select name="brand_status" id="" class="form-control">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>

                    </select>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="add_brand">Thêm thương hiệu</button>
            </div>

        </form>
    </div>
@endsection
