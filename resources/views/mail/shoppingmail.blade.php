<base href="{{ asset('') }}">
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
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                        Th??ng b??o ?????t h??ng th??nh c??ng
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                        Ch??o {{ $dataorder->Customer->customer_name }},
                                        <br> C??m ??n b???n ???? mua s???m t???i FoneeMobile
                                        <br>
                                        <br> ????n h??ng c???a b???n ??ang 
                                        <b>ch??? shop</b>  
                                        <b>x??c nh???n</b> (trong v??ng 24h)
                                        <br> Ch??ng t??i s??? th??ng tin <b>tr???ng th??i ????n h??ng</b> trong email ti???p theo.
                                        <br> B???n vui l??ng ki???m tra email th?????ng xuy??n nh??.
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
                                    <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                                        <b>????n h??ng c???a b???n #</b> 
                                        <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">{{ $dataorder->order_code }}
                                        </a>
                                        <span style="font-size:12px">({{date_format($dataorder->created_at,"d/m/Y H:i:s")}})</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px"> 
                                        <b>T??n Shop:  <a href="#" style="color:#115fff;text-decoration:none" target="_blank">
                                            FoneeMobile
                                        </a>
                                        - 0967074504</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                        <b>T???ng thanh to??n:  {{number_format($dataorder->order_total, 0, '.','.') }} ??</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                        <b>Ng?????i nh???n: <b>{{ $dataorder->Shipping->shipping_name }}</b> - {{ $dataorder->Shipping->shipping_phone }} -
                                        {{ $dataorder->Shipping->shipping_address }} - {{ $dataorder->Shipping->wards->ward_name }} - {{ $dataorder->Shipping->districts->district_name }} - {{ $dataorder->Shipping->cities->city_name }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                        <b>H??nh th???c thanh to??n: <b>{{($dataorder->Payment->payment_method == 1 )? 'Thanh to??n b???ng ATM' : 'Thanh to??n COD'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                        <b>Ghi ch??: <b>{{ $dataorder->Shipping->shipping_note }}
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
                                                    <th>T??n s???n ph???m</th>
                                                    <th>M??u s???c</th>
                                                    <th>B??? nh???</th>
                                                    <th>S??? l?????ng</th>
                                                    <th>Gi??</th>
                                                    <th>Th??nh ti???n</th>
                                                    </tr>
                                                        @foreach ($dataorderdetail as $item)
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
                                                                <td>{{number_format($item->product_price, 0, '.','.') }} ?? </td>
                                                                <td>{{number_format($subtotal, 0, '.','.') }} ??</td>
                                                            </tr> 
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="6" align="right" style="color: red; font-weight: bold;font-size: 20px;">T???ng c???ng:</td>
                                                            <td style="font-size: 20px; font-weight: bold">{{number_format($total, 0, '.','.') }} ??</td>  
                                                          <tr>                                                              
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <tr>
                                    <td colspan="2" align="center" valign="top" style="padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ebebeb">
                                        <a href="#" style="border:0px" target="_blank"> 
                                            <img src="https://i.imgur.com/f92hL68.jpg" height="29" width="191" alt="Chi ti???t ????n h??ng" style="border:0px"> 
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
                                    <td align="center" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px"> 
                                        ????y l?? th?? t??? ?????ng t??? h??? th???ng. Vui l??ng kh??ng tr??? l???i email n??y.
                                        <br> N???u c?? b???t k??? th???c m???c hay c???n gi??p ?????, B???n vui l??ng gh?? th??m 
                                        <b style="font-family:Arial,Helvetica,sans-serif;font-size:13px;text-decoration:none;font-weight:bold">Trung t??m tr??? gi??p</b> c???a ch??ng t??i t???i ?????a ch???: 
                                        <a href="#" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold" target="_blank">
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