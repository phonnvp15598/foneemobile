@extends('admin_layout')
@section('admin_header')
    <h1>
        Order
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.order.index') }}">Order</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Danh sách đơn hàng</h3>
                    <form class="form-inline pull-right">
                        <input type="text" value="{{ Request::get('order_code') }}" name="order_code" class="form-control"
                            placeholder="Mã code đơn hàng">
                        {{-- <input type="text" name="customer_name" value="{{Request::get('customer_name')}}" class="form-control" placeholder="Tên khách hàng"> --}}
                        <select name="order_status" id="" class="form-control">
                            <option value="" selected>Chọn trạng thái</option>
                            <option value="1" {{ Request::get('order_status') == 1 ? "selected='selected'" : '' }}>Đang chờ
                                tiếp nhận</option>
                            <option value="2" {{ Request::get('order_status') == 2 ? "selected='selected'" : '' }}>Đã tiếp
                                nhận</option>
                            <option value="3" {{ Request::get('order_status') == 3 ? "selected='selected'" : '' }}>Đang giao
                                hàng</option>
                            <option value="4" {{ Request::get('order_status') == 4 ? "selected='selected'" : '' }}>Đã nhận
                                hàng</option>
                            <option value="5" {{ Request::get('order_status') == 5 ? "selected='selected'" : '' }}>Đã hủy
                                đơn hàng</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- /.box-header -->

                <form action="{{ route('delete.order.selected') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit" id="deleteSelected"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa những mục đã chọn không?')">Xóa mục đã chọn <i
                            class="fa fa-trash"></i></button>
                    <a href="{{ route('admin.order.export') }}" class="btn btn-success"> Xuất Excel <i
                            class="fa fa-download"></i></a>
                    <div class="box-body table-responsive no-padding">
                        <table id="tableorder" class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th><input type="checkbox" name="" id="select_all"></th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Thời gian mua hàng</th>
                                    <th>Tình trạng</th>
                                    <th>Tổng giá tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox" name="ids[]"
                                                value="{{ $order->order_id }}"></td>
                                        <td>#{{ $order->order_code }}</td>
                                        <td>{{ $order->Customer->customer_name }}</td>
                                        <td>{{ date_format($order->created_at, 'd/m/Y H:i:s') }}</td>
                                        <td>
                                            <?php
                                            if($order->order_status == 1){ ?>
                                                          <span class="badge btn-danger">Đang chờ tiếp nhận</span>
                                                          <?php
                                            }elseif($order->order_status == 2) { ?>
                                                          <span class="badge btn-warning">Đã tiếp nhận</span>
                                                          <?php
                                            }elseif($order->order_status == 3) { ?>
                                                          <span class="badge btn-primary">Đang giao hàng</span>
                                                          <?php
                                            }elseif($order->order_status ==4) { ?>
                                                          <span class="badge btn-success">Đã nhận hàng</span>
                                                          <?php
                                            }else { ?>
                                                          <span class="badge btn-dark">Đã hủy đơn hàng</span>
                                                          <?php
                                            }          
                                          ?>

                                        </td>

                                        <td>{{ number_format($order->order_total, 0, '.', '.') }} Đ</td>
                                        <td>
                                            <a href="{{ route('admin.order.view', ['order_id' => $order->order_id]) }}"
                                                class="btn btn-success"><i class="fa fa-eye"></i></a>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')"
                                                href="{{ URL::to('/delete-order/' . $order->order_id) }}"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <a href="{{ route('admin.order.pdf', ['order_id' => $order->order_id]) }}"
                                                class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                {{ $orders->appends(Request::all())->links() }}
                            </ul>
                        </div>
                    </div>

                    <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
