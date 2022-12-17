<?php
namespace App\Helper;

class Date_Helper
{
    public static function getListDayInMonth()
    {
        $arrDay = [];
        $month = date('m');
        $year = date('Y');
        // Lấy các ngày trong tháng
        for ($day=1; $day<=31;$day++)
        {
            $time = mktime(12, 0, 0, $month, $day, $year);
                if(date('m',$time)==$month)
                    $arrDay[] = date('Y-m-d', $time);
        }
        return $arrDay;
    }
}
?>
