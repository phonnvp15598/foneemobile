@extends('admin_layout')
@section('admin_header')
    <h1>
        Bài viết
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.blog.index') }}">Bài viết</a></li>
        <li class="active">Add</li>
    </ol>
@endsection
@section('admin_content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title" style="color: red">Thêm bài viết</h1>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('admin.blog.save') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body ">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1">Tên bài viết</label>
                        <input type="text" class="form-control" name="blog_title" value="{{ old('product_name') }}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1">Hình bài viết</label>
                        <input type="file" class="form-control" name="blog_thumb" id="gallery-photo-add-one">
                        <div class="preview-img-one"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="exampleInputPassword1">Nội dung bài viết</label><br>
                        <textarea name="blog_content" id="ckeditor3" cols="70" rows="5"></textarea>
                    </div>
                    <div class="form-group col-sm-6 ">
                        <label for="exampleInputEmail1">Nổi bật</label>
                        <select name="blog_status" id="" class="form-control">
                            <option value="1">Ẩn</option>
                            <option value="2">Hiển thị</option>
                        </select>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="add_product">Thêm bài viết</button>
            </div>

        </form>
    </div>
@endsection
