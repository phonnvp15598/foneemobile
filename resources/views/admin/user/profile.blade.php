@extends('admin_layout')
@section('admin_header')
    <h1>
        Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.user.index') }}">User</a></li>
        <li class="active">Profile</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-md-12">
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <img class="profile-user-img" src="{{ asset('/public/uploads/product/' . $profile->avatar) }}"
                        alt="User profile picture">
                    <br>
                    <strong><i class="fa fa-user margin-r-5"></i> Username</strong>

                    <p class="text-muted">
                        {{ $profile->name }}
                    </p>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

                    <p class="text-muted">
                        {{ $profile->email }}
                    </p>
                    <hr>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#update{{ $profile->id }}"><b>Cập nhật
                            thông tin <i class="fa fa-pencil"></i></b></a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#change{{ $profile->id }}"><b>Đổi mật khẩu
                            <i class="fa fa-lock"></i></b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="modal fade" id="update{{ $profile->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Chỉnh sửa thông tin cá nhân</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="{{ route('admin.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                            value="{{ $profile->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                                            value="{{ $profile->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chọn avatar</label>

                                        <input type="file" class="form-control" id="gallery-photo-add-one" name="avatar">
                                        <img id="remove-one" src="{{ asset('/public/uploads/product/' . $profile->avatar) }}"
                                            alt="" width="100px">
                                        <div class="preview-img-one"></div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="upadte_brand">Lưu</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.box -->
            <div class="modal fade" id="change{{ $profile->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Thay đổi mật khẩu cá nhân</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="{{ route('admin.profile.changepass') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mật khẩu mới</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Xác nhận lại mật khẩu mới</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1"
                                            name="password_comfirm">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="upadte_brand">Lưu</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
@endsection
