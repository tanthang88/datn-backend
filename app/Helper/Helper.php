<?php

use Carbon\Carbon;

if (!function_exists('convertDateTimeToStr')) {
    function convertDateTimetoStr($date)
    {
        try {
            return Carbon::parse($date)->format(config('define.date_time_format'));
        } catch (\Throwable $th) {
            return '';
        }
    }
}
