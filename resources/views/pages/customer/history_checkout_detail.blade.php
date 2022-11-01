@extends('content')
<title>
    Chi tiết lịch sử mua hàng #{{$dataorder->order_code}}
</title>
<style>



</style>
@section('content')
<section id="cart_items">
    <div class="">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Trang chủ</a></li>
            <li><a href="{{route('customer.history')}}">Lịch sử mua hàng</a></li>
            <li style="color: red">Đơn hàng #{{$dataorder->order_code}}</li>
          </ul>
        <div class="review-payment" id="printPDF">
            <div class="info-order">
                <img src="https://imgur.com/XGKo1Yb.png" > <br>
                <b>Đơn hàng của bạn #</b> 
                <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" >{{ $dataorder->order_code }}
                </a>
                <span style="font-size:12px">({{date_format($dataorder->created_at,"d/m/Y H:i:s")}})</span><br>
                <b>Tên Shop:  <a href="#" style="color:#115fff;text-decoration:none" target="_blank">
                    FoneeMobile 
                </a>
                - 0967074504</b> <br>
                <b >Tổng thanh toán:  <p class="badge btn-danger">{{number_format($dataorder->order_total, 0, '.','.') }} Đ</p></b><br>
                <b>Người nhận: </b>{{ $dataorder->Shipping->shipping_name }}<br>
                <b>SĐT: </b> {{ $dataorder->Shipping->shipping_phone }}<br>
                <b>Địa chỉ giao hàng: {{ $dataorder->Shipping->shipping_address }} - {{ $dataorder->Shipping->wards->ward_name }}- {{ $dataorder->Shipping->districts->district_name }} - {{ $dataorder->Shipping->cities->city_name }}</b><br>                                  
                <b>Hình thức thanh toán: </b>{{($dataorder->Payment->payment_method == 1 )? 'Thanh toán bằng ATM' : 'Thanh toán COD'}}   <br>
                <b>Ghi chú: </b>{{ $dataorder->Shipping->shipping_note }} <br>
                <b>Trạng thái:  
                  <?php
                                    if($dataorder->order_status == 1){ ?>
                                        <span class="badge btn-danger">Đang chờ tiếp nhận</span>
                                    <?php
                                    }elseif($dataorder->order_status == 2) { ?>
                                        <span class="badge btn-warning">Đã tiếp nhận</span>
                                    <?php
                                    }elseif($dataorder->order_status == 3) { ?>
                                        <span class="badge btn-primary">Đang giao hàng</span>
                                    <?php
                                    }elseif($dataorder->order_status == 4) { ?>
                                        <span class="badge btn-success">Đã nhận hàng</span>
                                    <?php
                                    }
                                    else { ?>
                                        <span class="">Đã hủy đơn hàng</span>
                                    <?php
                                    }            
                                ?>
                </b>
                                      
            </div>
            <?php
                    if($dataorder->order_status == 1){ ?>
                     <div class="containertest">
                      <ol class="progress-meter">
                        <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($dataorder->created_at))}}</li>
                        <li class="progress-point todo">Ngày xử lý<br>X</li>
                        <li class="progress-point todo">Ngày giao hàng <br>X</li>
                        <li class="progress-point todo">Ngày nhận hàng <br>X</li>
                      </ol>
                      </div>
                      <?php
                    }elseif($dataorder->order_status == 2) { ?>
                        <div class="containertest">
                          <ol class="progress-meter">
                            <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($dataorder->created_at))}}</li>
                            <li class="progress-point done">Ngày xử lý <br>{{date('d-m-Y H:i:s', strtotime($dataorder->day_handle))}}</li>
                            <li class="progress-point todo">Ngày giao hàng <br>X</li>
                            <li class="progress-point todo">Ngày nhận hàng <br>X</li>
                          </ol>
                      </div>
                      <?php
                    }elseif($dataorder->order_status == 3) { ?>
                       <div class="containertest">
                        <ol class="progress-meter">
                            <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($dataorder->created_at))}}</li>
                            <li class="progress-point done">Ngày xử lý <br>{{date('d-m-Y H:i:s', strtotime($dataorder->day_handle))}}</li>
                            <li class="progress-point done">Ngày giao hàng <br>{{date('d-m-Y H:i:s', strtotime($dataorder->day_ship))}}</li>
                            <li class="progress-point todo">Ngày nhận hàng <br>X</li>
                        </ol>
                      </div>
                      <?php
                    }elseif($dataorder->order_status == 4) { ?>
                        <div class="containertest">
                          <ol class="progress-meter">
                            <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($dataorder->created_at))}}</li>
                            <li class="progress-point done">Ngày xử lý <br>{{date('d-m-Y H:i:s', strtotime($dataorder->day_handle))}}</li>
                            <li class="progress-point done">Ngày giao hàng <br>{{date('d-m-Y H:i:s', strtotime($dataorder->day_ship))}}</li>
                            <li class="progress-point done">Ngày nhận hàng <br>{{date('d-m-Y H:i:s', strtotime($dataorder->updated_at))}}</li>
                          </ol>
                      </div>
                    <?php
                    }          
            ?>
            <div class="box-body table-responsive no-padding">
                <table id="tableorder" class="table table-bordered table-striped">
                    @php
                    $i =0;
                    $total =0;
                    
                @endphp
                <tbody>
                    <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>  
                    <th>Tên sản phẩm</th>
                    <th>Màu sắc</th>
                    <th>Bộ nhớ</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    </tr>
                        @foreach ($dataorderdetail as $item)
                            @php
                                $i++;
                                $subtotal= $item->product_price*$item->product_sale_quantity; 
                                $total += $subtotal;
                            @endphp                   
                            <tr>
                                <td>{{$i}}</td>
                                <td><img src="{{URL::to('/public/uploads/product/'.$item->Product->product_image)}}" alt="" width="75px"></td>
                                <td><a href="{{URL::to('/product/'.$item->Product->product_slug)}}">{{$item->product_name}}</a></td>
                                <td>{{$item->product_color}} </td>
                                <td>{{$item->product_memory}} </td>
                                <td>{{$item->product_sale_quantity}} </td>
                                <td>{{number_format($item->product_price, 0, '.','.') }} Đ </td>
                                <td>{{number_format($subtotal, 0, '.','.') }} Đ</td>
                            </tr> 
                        @endforeach
                        <tr>
                            <td><a href="{{route('customer.history')}}" class="btn btn-primary">Lịch sử </a></td>
                            <td><a class="btn btn-primary" onclick="printJS('printPDF', 'html')">In hóa đơn</a></td>
                            <td colspan="5" align="right" style="color: red; font-weight: bold;font-size: 20px;">Tổng cộng:</td>
                            <td style="font-size: 20px; font-weight: bold">{{number_format($total, 0, '.','.') }} Đ</td>  
                          <tr>                                                              
                </tbody>
                </table>
            </div>

        </div>
        
        
        
      
  
       
    </div>
</section> <!--/#cart_items-->

@endsection