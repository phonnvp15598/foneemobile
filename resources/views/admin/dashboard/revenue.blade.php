@extends('admin_layout')
@section('admin_header')
    <h1>
        Doanh thu
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="active">Revenue</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">

        <section class="col-lg-12 connectedSortable">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Quản lý doanh thu </h3>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-xs-3">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4>{{ number_format($moneyDay, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu ngày hôm nay</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-3">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4>{{ number_format($moneyWeek, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu tuần này</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-3">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h4>{{ number_format($moneyMonth, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu tháng này</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-3">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h4>{{ number_format($moneyYear, 0, '.', '.') }} Đ</h4>

                                <p>Doanh thu năm này</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="col-lg-7 connectedSortable">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Thống kê doanh thu</h3>
                    <form class="form-inline pull-right">
                        <select name="revenue_day" id="" class="form-control">
                            <option value="" selected>---Chọn ngày---</option>
                            <?php
                             for($i=1 ; $i<=31 ;$i++){ 
                            ?>
                            <option value="{{ $i }}"
                                {{ Request::get('revenue_day') == $i ? "selected='selected'" : '' }}>Ngày
                                {{ $i }}</option>
                            <?php
                            }
                        ?>
                        </select>
                        <select name="revenue_month" id="" class="form-control">
                            <option value="" selected>---Chọn tháng---</option>
                            <?php
                         for($i=1 ; $i<=12 ;$i++){ 
                        ?>
                            <option value="{{ $i }}"
                                {{ Request::get('revenue_month') == $i ? "selected='selected'" : '' }}>Tháng
                                {{ $i }}</option>
                            <?php
                         }
                        
                    ?>
                        </select>
                        <select name="revenue_year" id="" class="form-control">
                            <option value="" selected>---Chọn năm---</option>
                            <?php
                         for($i=2019 ; $i<=2022 ;$i++){ 
                        ?>
                            <option value="{{ $i }}"
                                {{ Request::get('revenue_year') == $i ? "selected='selected'" : '' }}>Năm
                                {{ $i }}</option>
                            <?php
                        }
                    ?>
                        </select>
                        <button type="submit" class="btn btn-primary">Thống kê <i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4>{{ number_format($revenue, 0, '.', '.') }} Đ</h4>

                        <p>Doanh thu </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>

                </div>
            </div>
        </section>

    </div>
@endsection
