
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>
    <style>
        body {
        font-family: 'Times New Roman', sans-serif;
        }
    </style>

</head>
<body>
    <div marginheight="0" marginwidth="0" style="background:#f0f0f0">
        <div id="wrapper" style="background-color:#f0f0f0">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
                <tbody>
                    <tr>
                        <td align="center" valign="middle" style="background:#ffffff">
                            <table style="width:580px;border-bottom:1px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="left" valign="middle" style="width:500px;height:60px">
                                            <a href="#" style="border:0" target="_blank" width="130" height="35" style="display:block;border:0px">
                                                <img src="https://imgur.com/XGKo1Yb.png"  style="margin-top:20px;display:block;border:0px;float: left;"> 
                                            </a>
                                        </td>
                                        <td align="right" valign="middle" style="padding-right:15px">
                                            <a href="" style="border:0"> 
                                                <img src="https://i.imgur.com/eL1uAJx.png" height="36" width="115" style="display:block;border:0px"> 
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" style="background:#ffffff">
                            <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="left" valign="middle" style="font-family:Times New Roman,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                            Thông báo đặt hàng thành công
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="middle" style="font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                            Chào {{ $order_info->customer_name }},
                                            <br> Cám ơn bạn đã mua sắm tại FoneeMobile
                                            <br>
                                            <br> Đơn hàng của bạn đang 
                                            <b>chờ shop</b>  
                                            <b>xác nhận</b> (trong vòng 24h)
                                            <br> Chúng tôi sẽ thông tin <b>trạng thái đơn hàng</b> trong email tiếp theo.
                                            <br> Bạn vui lòng kiểm tra email thường xuyên nhé.
                                        </td>
                                    </tr>
                                    
                                
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" style="background:#ffffff">
                            <table style="width:580px;border:1px solid #ff3333;border-top:3px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td colspan="2" align="left" valign="top" style="font-family:Times New Roman,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                                            <b>Đơn hàng của bạn #</b> 
                                            <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">{{ $order_info->order_code}}
                                            </a>
                                            <span style="font-size:12px">{{date_format($order_date->created_at,"d/m/Y H:i:s")}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px"> 
                                            <b>Tên Shop:  <a href="#" style="color:#115fff;text-decoration:none" target="_blank">
                                                FoneeMobile
                                            </a>
                                            - 0967074504</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                            <b>Tổng thanh toán:  {{number_format($order_info->order_total, 0, '.','.') }} Đ</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                            <b>Người nhận: <b>{{ $order_info->shipping_name }}</b> - {{ $order_info->shipping_phone }} -
                                            {{ $order_info->shipping_address }} - {{$order_info->Shipping->wards->ward_name }} - {{$order_info->Shipping->districts->district_name }} - {{$order_info->Shipping->cities->city_name }} </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                            <b>Hình thức thanh toán: <b>{{($order_info->payment_method == 1 )? 'Thanh toán bằng ATM' : 'Thanh toán COD'}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                            <b>Ghi chú: <b>{{ $order_info->shipping_note }}
                                        </td>
                                    </tr>
                                        <tr>    
                                            <td align="center" valign="middle">
                                                <table style="width: 500px;margin-left: 16px;" cellpadding="0" cellspacing="0" border="1">
                                                    @php
                                                        $i =0;
                                                        $total =0;
                                                        
                                                    @endphp
                                                    <tbody>
                                                        <tr>
                                                        <th>STT</th>  
                                                        <th>Tên sản phẩm</th>
                                                        <th>Màu sắc</th>
                                                        <th>Bộ nhớ</th>
                                                        <th>Số lượng</th>
                                                        <th>Giá</th>
                                                        <th>Tổng</th>
                                                        </tr>
                                                            @foreach ($order_detail as $item)
                                                                @php
                                                                    $i++;
                                                                    $subtotal= $item->product_price*$item->product_sale_quantity; 
                                                                    $total += $subtotal;
                                                                @endphp                   
                                                                <tr>
                                                                    <td>{{$i}}</td>
                                                                    <td>{{$item->product_name}}</td>
                                                                    <td>{{$item->product_color}}</td>
                                                                    <td>{{$item->product_memory}}</td>
                                                                    <td>{{$item->product_sale_quantity}} </td>
                                                                    <td>{{number_format($item->product_price, 0, '.','.') }} Đ </td>
                                                                    <td>{{number_format($subtotal, 0, '.','.') }} Đ</td>
                                                                </tr> 
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="6" align="right" style="color: red; font-weight: bold;font-size: 20px;">Thành tiền:</td>
                                                                <td style="font-size: 20px; font-weight: bold">{{number_format($total, 0, '.','.') }} Đ</td>  
                                                              <tr>                                                              
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    <tr>
                                        <td colspan="2" align="center" valign="top" style="padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ebebeb">
                                            <a href="#" style="border:0px" target="_blank"> 
                                                <img src="https://i.imgur.com/f92hL68.jpg" height="29" width="191" alt="Chi tiết đơn hàng" style="border:0px"> 
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                            <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="middle" style="font-family:Times New Roman,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px"> 
                                            Đây là thư tự động từ hệ thống. Vui lòng không trả lời email này.
                                            <br> Nếu có bất kỳ thắc mắc hay cần giúp đỡ, Bạn vui lòng ghé thăm 
                                            <b style="font-family:Times New Roman,sans-serif;font-size:13px;text-decoration:none;font-weight:bold">Trung tâm trợ giúp</b> của chúng tôi tại địa chỉ: 
                                            <a href="#" style="font-family:Times New Roman,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold" target="_blank">
                                                foneeshoplaravel@gmail.com
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> 
    </div>
</body>
</html>

