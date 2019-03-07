<?php defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('thai_month_arr'))
{
    function thai_month_arr($month)
    {
        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        return $thai_month_arr[$month];
    }
}

if (!function_exists('thai_month_arr_short'))
{
    function thai_month_arr_short($month)
    {
        $thai_month_arr_short = [
            "0"  => "",
            "1"  => "ม.ค.",
            "2"  => "ก.พ.",
            "3"  => "มี.ค.",
            "4"  => "เม.ย.",
            "5"  => "พ.ค.",
            "6"  => "มิ.ย.",
            "7"  => "ก.ค.",
            "8"  => "ส.ค.",
            "9"  => "ก.ย.",
            "10" => "ต.ค.",
            "11" => "พ.ย.",
            "12" => "ธ.ค.",
        ];

        return $thai_month_arr_short[$month];
    }
}

if (!function_exists('default_time'))
{
    function thai_time($time)
    {
        $thai_date_return = date("H:i", $time);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_and_time'))
{
    function thai_date_and_time($time)
    {
        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . thai_month_arr(date("n", $time));
        $thai_date_return .= " " . (date("Y", $time) + 543);
        $thai_date_return .= " " . date("H:i", $time);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_and_time_short'))
{
    function thai_date_and_time_short($time)
    {
        $thai_date_return = date("j", $time);
        $thai_date_return .= "&nbsp;" . thai_month_arr_short(date("n", $time));
        $thai_date_return .= " " . (date("Y", $time) + 543);
        $thai_date_return .= " " . date("H:i", $time);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_short'))
{
    function thai_date_short($time)
    {
        $thai_date_return = date("j", $time);
        $thai_date_return .= "&nbsp;" . thai_month_arr_short(date("n", $time));
        $thai_date_return .= " " . (date("Y", $time) + 543);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_fullmonth'))
{
    function thai_date_fullmonth($time)
    {
        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . thai_month_arr(date("n", $time));
        $thai_date_return .= " " . (date("Y", $time) + 543);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_short_number'))
{
    function thai_date_short_number($time)
    {
        $thai_date_return = date("d", $time);
        $thai_date_return .= "-" . date("m", $time);
        $thai_date_return .= "-" . substr((date("Y", $time) + 543), -2);

        return $thai_date_return;
    }
}

if (!function_exists('convert_datetime'))
{
    function convert_datetime($datetime = '', $format_input = '', $format_output = '')
    {
        $newDate = DateTime::createFromFormat($format_input, $datetime);
        $datetime_output = $newDate->format($format_output);

        return $datetime_output;
    }
}

if (!function_exists('convert_datetime_thai'))
{
    function convert_datetime_thai($datetime = '', $format_input = '', $format_output = '')
    {
        $newDate = DateTime::createFromFormat($format_input, $datetime);
        $datetime_output = $newDate->format($format_output);

        return $datetime_output;
    }
}

if (!function_exists('create_hours'))
{
    function create_hours()
    {
        $hours = array();

        for ($i = 0; $i <= 23; $i++) { 
            $hour_format = sprintf("%'.02d", $i);
            $hours[$hour_format] = $hour_format;
        }

        return $hours;
    }
}

if (!function_exists('create_minutes'))
{
    function create_minutes()
    {
        $minutes = array();

        for ($i = 0; $i <= 59; $i++) { 
            $minute_format = sprintf("%'.02d", $i);
            $minutes[$minute_format] = $minute_format;
        }

        return $minutes;
    }
}