<?php 
namespace App\Helpers;
class Date
{
    public static function getListDayInMonth($month){
        $arrayDay = [];
        // $month = date('m');
        $year = date('Y');
        //lay tat ca cac ngay trong thang
        for($day =1 ; $day <= 31; $day++){
            $time = mktime(12,0,0,$month,$day,$year);
            if(date('m',$time)== $month){
                $arrayDay[] = date('Y-m-d', $time);
            }
        }
        return $arrayDay;

    }

}
