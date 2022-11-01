@extends('admin_layout')
@section('admin_header')
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('admin_content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $count_order }}</h3>

                    <p>Đơn hàng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.order.index') }}" class="small-box-footer">Xem chi tiết <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $count_product }}</h3>

                    <p>Sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.product.index') }}" class="small-box-footer">Xem chi tiết <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $count_brand }}</h3>

                    <p>Thương hiệu</p>
                </div>
                <div class="icon">
                    <i class="fa fa-free-code-camp"></i>
                </div>
                <a href="{{ route('admin.brand.index') }}" class="small-box-footer">Xem chi tiết <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $count_blog }}</h3>

                    <p>Bài viết</p>
                </div>
                <div class="icon">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <a href="{{ route('admin.blog.index') }}" class="small-box-footer">Xem chi tiết <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Danh sách đơn hàng chưa xử lý </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Thời gian mua hàng</th>
                                <th>Tình trạng</th>
                                <th>Tổng giá tiền</th>
                            </tr>
                            @foreach ($all_order as $order)
                                <tr>
                                    <td>#{{ $order->order_code }}</td>
                                    <td>{{ $order->Customer->customer_name }}</td>
                                    <td>{{ date_format($order->created_at, 'd/m/Y H:i:s') }}</td>
                                    <td>
                                        <span class="badge btn-danger">Đang chờ tiếp nhận</span>
                                    </td>
                                    <td>{{ number_format($order->order_total, 0, '.', '.') }} Đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="pull-right" href="{{ route('admin.order.index') }}" class="small-box-footer">Xem chi tiết <i
                            class="fa fa-arrow-circle-right"></i></a>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $all_order->links() }}
                        </ul>
                    </div>
                </div>
            </div>


        </section>

        
        <section class="col-lg-7 ">
            <div class="box box-primary">
                <figure class="highcharts-figure">
                    <div id="container3" data-order-status="{{$statusOrder}}"></div>
                  </figure>
        
               </div>
        </section>
        <section class="col-lg-5 connectedSortable">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Quản lý doanh thu </h3>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4>{{ number_format($moneyDay, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu ngày</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4>{{ number_format($moneyWeek, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu tuần</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h4>{{ number_format($moneyMonth, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu tháng</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h4>{{ number_format($moneyYear, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu năm</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <a class="pull-right" href="{{ route('admin.dashboard.revenue') }}" class="small-box-footer">Xem
                            chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>
            </div>

        </section> 
        <div class="col-lg-12">
            <div class="pull-right">
                <form class="form-inline" id="revenueby">
                    <select name="revenuebymonth" class="form-control revenuebymonth">
                        <option value="" selected>---Chọn tháng---</option>
                        <?php
                     for($i=1 ; $i<=12 ;$i++){ 
                    ?>
                        <option value="{{ $i }}"
                            {{ Request::get('revenuebymonth') == $i ? "selected='selected'" : '' }}>Tháng
                            {{ $i }}</option>
                        <?php
                     }
                    
                ?>
                    </select>
                    
                    
            </form>
            </div>
        </div> 
       <div class="col-sm-12 box box-primary">
        <figure class="highcharts-figure">
            <div id="container2" data-list-day="{{$listDay}}" data-money="{{$revenueDay}}" data-money-default="{{$revenueDayDefault}}"></div>
        </figure>

       </div>
    </div>
@endsection

   
