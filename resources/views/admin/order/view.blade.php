@extends('admin_layout')
@section('admin_header')
  <h1>
    Order
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.blank')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('admin.order.index')}}">Order</a></li>
    <li class="active">View</li>
  </ol>
@endsection
<style>
  .progress-meter {
  padding: 0;
}

ol.progress-meter {
  padding-bottom: 9.5px;
  padding: 10px 0;
  list-style-type: none;
}
ol.progress-meter li {
  display: inline-block;
  text-align: center;
  text-indent: -19px;
  height: 36px;
  width: 24.99%;
  font-size: 12px;
  border-bottom-width: 4px;
  border-bottom-style: solid;
  margin-right: -4px
}
ol.progress-meter li:before {
  position: relative;
  float: left;
  text-indent: 0;
  left: -webkit-calc(50% - 9.5px);
  left: -moz-calc(50% - 9.5px);
  left: -ms-calc(50% - 9.5px);
  left: -o-calc(50% - 9.5px);
  left: calc(50% - 9.5px);
}
ol.progress-meter li.done {
  font-size: 12px;
}
ol.progress-meter li.done:before {
  content: "\2713";
  height: 19px;
  width: 19px;
  line-height: 21.85px;
  bottom: -36.175px;
  border: none;
  border-radius: 19px;
}
ol.progress-meter li.todo {
  font-size: 12px;
}
ol.progress-meter li.todo:before {
  content: "\2B24";
  font-size: 17.1px;
  bottom: -36.175px;
  line-height: 18.05px;
}
ol.progress-meter li.done {
  color: black;
  border-bottom-color: #4287f5;
  padding-bottom: 44px
}
ol.progress-meter li.done:before {
  color: white;
  background-color: #4287f5;
}
ol.progress-meter li.todo {
  color: silver;
  border-bottom-color: silver;
  padding-bottom: 44px;
}
ol.progress-meter li.todo:before {
  color: silver;
}
</style>
@section('admin_content')
<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Thông tin khách hàng</h3>
        </div>
        <!-- /.box-header -->
       
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
                <tr>
                <th>Mã đơn hàng</th>
                <th>Tên người đặt</th>
                <th>Email</th>
                </tr>
                    <tr>
                        <td>{{$order_info->order_code}}</td>
                        <td>{{$order_info->customer_name}}</td>
                        <td>{{$order_info->customer_email}}</td>
                    </tr> 
        
             </tbody>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Thông tin vận chuyển</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
                  <tr>
                  <th>Tên người nhận</th>
                  <th>Số điện thoại</th>
                  <th>Email</th>
                  <th>Địa chỉ</th>
                  <th>Hình thức thanh toán</th>
                  <th>Ngày đặt hàng</th>
                  <th>Ghi chú</th>
                  </tr>
                      <tr>
                          <td>{{$order_info->shipping_name}}</td>
                          <td>{{$order_info->shipping_phone}}</td>
                          <td>{{$order_info->shipping_email}}</td>
                          <td>{{$order_info->shipping_address}}-{{$order_address->wards->ward_name}}-{{$order_address->districts->district_name}}-{{$order_address->cities->city_name}}</td>
                          <td>{{($order_info->payment_method == 1 )? 'Thanh toán bằng ATM' : 'Thanh toán COD'}}</td>
                          <td>{{date_format($order_date->created_at,"d/m/Y H:i:s")}}</td>
                          <td>{{$order_info->shipping_note}}</td>
                      </tr> 
          
               </tbody>
              </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Thông tin chi tiết đơn hàng</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
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
                            <td><img src="{{asset('/public/uploads/product/'. $item->Product->product_image)}}" alt="" width="75px"></td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->product_color}}</td>
                            <td>{{$item->product_memory}}</td>
                            <td>{{$item->product_sale_quantity}} </td>
                            <td>{{number_format($item->product_price, 0, '.','.') }} Đ</td>
                            <td>{{number_format($subtotal, 0, '.','.') }} Đ</td>
                        </tr> 
                        @endforeach
                        <tr>
                          <td colspan="7" align="right" style="color: red; font-weight: bold;font-size: 20px;">Tổng cộng :</td>
                          <td style="font-size: 20px; font-weight: bold"><span class="badge btn-danger" style="font-size: 22px">{{number_format($total, 0, '.','.') }} Đ</span></td>  
                        <tr>
               </tbody>
              </table>
          </div>
          
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Trạng thái đơn hàng</h3>
            <?php
            if($order_info->order_status == 1){ ?>
              <span class="badge btn-danger">Đang chờ tiếp nhận</span>
              <?php
            }elseif($order_info->order_status == 2) { ?>
                <span class="badge btn-warning">Đã tiếp nhận</span>
              <?php
            }elseif($order_info->order_status == 3) { ?>
                <span class="badge btn-primary">Đang giao hàng</span>
              <?php
            }elseif($order_info->order_status == 4) { ?>
                <span class="badge btn-success">Đã nhận hàng</span>
              <?php
            }
            else { ?>
                <span class="badge btn-dark">Đã hủy đơn hàng</span>
             <?php
            }               
            ?>
           <?php
           if($order_info->order_status == 1){ ?>
            <div class="containertest">
             <ol class="progress-meter">
               <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($order_date->created_at))}}</li>
               <li class="progress-point todo">Ngày xử lý<br>X</li>
               <li class="progress-point todo">Ngày giao hàng <br>X</li>
               <li class="progress-point todo">Ngày nhận hàng <br>X</li>
             </ol>
             </div>
             <?php
           }elseif($order_info->order_status == 2) { ?>
               <div class="containertest">
                 <ol class="progress-meter">
                  <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($order_date->created_at))}}</li>
                  <li class="progress-point done">Ngày xử lý <br>{{date('d-m-Y H:i:s', strtotime($order_date->day_handle))}}</li>
                  <li class="progress-point todo">Ngày giao hàng <br>X</li>
                  <li class="progress-point todo">Ngày nhận hàng <br>X</li>
                 </ol>
             </div>
             <?php
           }elseif($order_info->order_status == 3) { ?>
              <div class="containertest">
               <ol class="progress-meter">
                  <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($order_date->created_at))}}</li>
                   <li class="progress-point done">Ngày xử lý <br>{{date('d-m-Y H:i:s', strtotime($order_date->day_handle))}}</li>
                   <li class="progress-point done">Ngày giao hàng <br>{{$order_date->day_ship}}</li>
                   <li class="progress-point todo">Ngày nhận hàng <br>X</li>
               </ol>
             </div>
             <?php
           }elseif($order_info->order_status == 4) { ?>
               <div class="containertest">
                 <ol class="progress-meter">
                   <li class="progress-point done">Ngày đặt <br>{{date('d-m-Y H:i:s', strtotime($order_date->created_at))}}</li>
                   <li class="progress-point done">Ngày xử lý <br>{{date('d-m-Y H:i:s', strtotime($order_date->day_handle))}}</li>
                   <li class="progress-point done">Ngày giao hàng <br>{{date('d-m-Y H:i:s', strtotime($order_date->day_ship))}}</li>
                   <li class="progress-point done">Ngày nhận hàng <br>{{date('d-m-Y H:i:s', strtotime($order_date->updated_at))}}</li>
                 </ol>
             </div>
           <?php
           }          
   ?>
            <form action="{{route('admin.order.update',['order_id' => $order_info->order_id])}}" method="post">
              @csrf
              <div class="form-group col-sm-4">
                <select name="order_status" id="" class="form-control">
                  @foreach ($order_status as $key => $status)                   
                    @if ($status->order_status == $order_info->order_status)
                    <option selected value="{{$status->order_status}}">{{$status->order_status_name}}</option> 
                    @else
                    <option  value="{{$status->order_status}}">{{$status->order_status_name}}</option> 
                    @endif        
                  @endforeach                  
              </select>
                <button type="submit" class="btn btn-primary">Xử lý</button>
              </div>
              
            </form>      
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
  </div>
@endsection