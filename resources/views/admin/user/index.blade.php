@extends('admin_layout')
@section('admin_header')
    <h1>
        Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.user.index') }}">User</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Danh sách người dùng</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Author</th>
                                <th>User</th>
                                {{-- <th>Quyền</th> --}}
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($users as $user)

                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <form action="{{ route('assign.user') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $user->email }}">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><input type="checkbox" name="admin_role"
                                                {{ $user->hasRole('admin') ? 'checked' : '' }}></td>
                                        <td><input type="checkbox" name="author_role"
                                                {{ $user->hasRole('author') ? 'checked' : '' }}></td>
                                        <td><input type="checkbox" name="user_role"
                                                {{ $user->hasRole('user') ? 'checked' : '' }}></td>

                                        <td>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fa fa-pencil"></i></button>
                                    </form>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')"
                                        href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="btn btn-danger"><i
                                            class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $users->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
