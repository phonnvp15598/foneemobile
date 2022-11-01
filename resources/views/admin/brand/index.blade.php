@extends('admin_layout')
@section('admin_header')
    <h1>
        Brand
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.brand.index') }}">Brand</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add">
                    <i class="fa fa-plus"></i> Thêm thương hiệu
                </button>
                <div class="box-header">
                    <h3 class="box-title">Danh sách thương hiệu</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="add">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Thêm thương hiệu sản phẩm</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ route('admin.brand.save') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="brand_name" value="{{ old('brand_name') }}">
                                            @error('brand_name')
                                                <p class="badge btn-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mô tả thương hiệu</label><br>
                                            <textarea name="brand_desc" id="" rows="3"
                                                class="form-control">{{ old('brand_desc') }}</textarea>
                                            @error('brand_desc')
                                                <p class="badge btn-danger">{{ $message }}</p>
                                            @enderror
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

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary" name="add_brand">Lưu</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th><input type="checkbox" name="" id=""></th>
                                <th>Tên thương hiệu</th>
                                <th>Hiển thị</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($all_brand as $key => $brand)
                                <tr>
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>
                                        <?php
                                if($brand->brand_status == 0){ ?>
                                        <a style="color: red"
                                            href="{{ route('admin.brand.active', ['brand_id' => $brand->brand_id]) }}"><i
                                                class="fa fa-thumbs-down"></i></a>
                                        <?php
                                }else { ?>
                                        <a href="{{ route('admin.brand.unactive', ['brand_id' => $brand->brand_id]) }}"><i
                                                class="fa fa-thumbs-up"></i></a>
                                        <?php
                                }
                               
                          ?>
                                    </td>
                                    <td>{{ $brand->brand_desc }}</td>
                                    <td>
                                        <a class="btn btn-success" data-toggle="modal"
                                            data-target="#edit{{ $brand->brand_id }}"><i class="fa fa-pencil"></i></a>
                                        <a href="" class="btn btn-danger" data-toggle="modal"
                                            data-target="#delete{{ $brand->brand_id }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <td>
                                        <div class="modal fade" id="edit{{ $brand->brand_id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Chỉnh sửa thương hiệu sản phẩm</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form"
                                                            action="{{ route('admin.brand.update', ['brand_id' => $brand->brand_id]) }}"
                                                            method="POST">
                                                            {{ csrf_field() }}
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputEmail1" name="brand_name"
                                                                        value="{{ $brand->brand_name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Mô tả thương
                                                                        hiệu</label><br>
                                                                    <textarea name="brand_desc" id="" rows="3"
                                                                        class="form-control">{{ $brand->brand_desc }}</textarea>
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Hủy</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            name="upadte_brand">Lưu</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <div class="modal fade" id="delete{{ $brand->brand_id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('admin.brand.delete', ['brand_id' => $brand->brand_id]) }}"
                                                        method="get">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Xác nhận xóa thương hiệu
                                                                {{ $brand->brand_name }}</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="delete_brand">Lưu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $all_brand->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
