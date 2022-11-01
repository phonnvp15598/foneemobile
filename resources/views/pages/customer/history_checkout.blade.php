@extends('content')
<title>
    Lịch sử mua hàng 
</title>
@section('content')
<section id="cart_items">
    <div class="">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Trang chủ</a></li>
            <li style="color: red">Lịch sử mua hàng</li>
          </ul>
        
        <div class="review-payment">
            <div class="box-body table-responsive no-padding">
                <table id="tableorder" class="table table-bordered table-striped">
                  <tbody>
                      <tr>
                      <th>Mã đơn hàng</th>
                      <th>Tên khách hàng</th>
                      <th>Thời gian mua hàng</th>
                      <th>Tình trạng</th>
                      <th>Tổng giá tiền</th>
                      <th>Thao tác</th>
                      </tr>
                      @foreach ($dataorder as $order)
                          <tr>
                              <td>#{{$order->order_code}}</td>
                              <td>{{$order->Customer->customer_name}}</td>
                              <td>{{date_format($order->created_at,"d/m/Y H:i:s")}}</td>
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
                                    }elseif($order->order_status == 4) { ?>
                                        <span class="badge btn-success">Đã nhận hàng</span>
                                    <?php
                                    }
                                    else { ?>
                                        <span class="">Đã hủy đơn hàng</span>
                                    <?php
                                    }            
                                ?>
                                
                              </td>
                              
                              <td>{{number_format($order->order_total, 0, '.','.') }} Đ</td>
                              <td>
                                  <a  href="{{route('customer.history.detail',['order_id' => $order->order_id])}}"  class="btn btn-warning"><i class="fa fa-eye"> </i></a>
                                  <?php 
                                    if ($order->order_status ==1 || $order->order_status ==2||$order->order_status ==3) { ?>
                                        <a  onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng #{{$order->order_code}} không?')" href="{{route('customer.order.cancel',['order_id' => $order->order_id])}}"  class="btn btn-danger"><i class="fa fa-times"></i></a>
                                    <?php
                                    }
                                  ?>
                                  
                              </td>    
                          </tr>  
                      @endforeach
              
                  </tbody>
                  </table>
              </div>
        </div>
        
      
  
       
    </div>
</section> <!--/#cart_items-->

@endsection