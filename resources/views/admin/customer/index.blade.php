@extends('admin_layout')
@section('admin_header')
    <h1>
        Customer
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.customer.index') }}">Customer</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Danh sách khách hàng</h3>

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
                                <th><input type="checkbox" name="" id=""></th>
                                <th>Tên khách hàng</td>
                                <th>Email</th>
                                <th>Trạng thái </th>
                                <th>Thao tác</th>
                            </tr>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ $customer->customer_name }}</td>
                                    <td>{{ $customer->customer_email }}</td>
                                    <td>
                                        <?php
                                  if($customer->customer_active == 1){ ?>
                                        <span class="badge btn-danger">Chưa kích hoạt</span>
                                        <?php
                                  }else { ?>
                                        <span class="badge btn-success">Đã kích hoạt</span>
                                        <?php
                                  }     
                            ?>

                                    </td>
                                    <td>
                                        <a class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa {{ $customer->customer_name }} không?')"
                                            href="{{ route('admin.customer.delete', ['customer_id' => $customer->customer_id]) }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $customers->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
