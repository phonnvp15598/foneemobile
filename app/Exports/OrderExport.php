<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return [
            'Mã đơn hàng',
            'Tên khách hàng',
            'Số điện thoại',
            'Email',
            'Địa chỉ',
            'Phường/Xã',
            'Quận/Huyện',
            'Tỉnh/Thành Phố',
            'Thời gian mua',
            'Thời gian xác nhận',
            'Tình trạng' ,
            'Thành tiền' 
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::join('tbl_shipping', 'tbl_shipping.shipping_id','=', 'tbl_order.shipping_id')
        ->join('cities', 'cities.city_id','=','tbl_shipping.city_id')
        ->join('districts', 'districts.district_id','=','tbl_shipping.district_id')
        ->join('wards', 'wards.ward_id','=','tbl_shipping.ward_id')
        ->select('order_code','tbl_shipping.shipping_name','tbl_shipping.shipping_phone','tbl_shipping.shipping_email','tbl_shipping.shipping_address','wards.ward_name','districts.district_name','cities.city_name', 'tbl_order.created_at','tbl_order.updated_at','order_status','order_total')->get();
    }
}
