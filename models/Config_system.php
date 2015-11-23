<?php

namespace app\models;

use Yii;
use yii\base\Model;

//Create By Kimniyom

class Config_system {

    function autoId($table, $value, $number) {
        $rs = Yii::$app->db->createCommand("Select Max($value)+1 as MaxID from  $table")->queryOne(); //เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย
        $new_id = $rs['MaxID'];
        if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
            $std_id = sprintf("%0" . $number . "d", 1); //ถ้าไม่ใช่ค่าว่าง
        } else {
            $std_id = sprintf("%0" . $number . "d", $new_id); //ถ้าไม่ใช่ค่าว่าง
        }

        return $std_id;
    }
    
    function autoId_order($table, $value, $number) {
        $rs = Yii::$app->db->createCommand("Select Max(RIGHT($value,4))+1 as MaxID from  $table")->queryOne(); //เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย
        $new_id = $rs['MaxID'];
        if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
            $std_id = sprintf("%0" . $number . "d", 1); //ถ้าไม่ใช่ค่าว่าง
        } else {
            $std_id = sprintf("%0" . $number . "d", $new_id); //ถ้าไม่ใช่ค่าว่าง
        }

        return $std_id;
    }

    function thaidate($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
        }
    }

    function Monthval() {
        $month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        return $month;
    }

    function MonthFull() {
        $thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thai_month;
    }
    
    function MonthFullKey() {
        $thai_month = array(
            "01" => "มกราคม", 
            "02" => "กุมภาพันธ์", 
            "03" => "มีนาคม", 
            "04" => "เมษายน", 
            "05" => "พฤษภาคม", 
            "06" => "มิถุนายน", 
            "07" => "กรกฏาคม", 
            "08" => "สิงหาคม", 
            "09" => "กันยายน", 
            "10" => "ตุลาคม", 
            "11" => "พฤศจิกายน", 
            "12" => "ธันวาคม");
        return $thai_month;
    }

    function MonthShot() {
        $thai = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        return $thai;
    }

    function MonthFullArray() {
        $thai_month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thai_month;
    }

    function get_age($birthday = '') {
        $then = strtotime($birthday);
        return(floor((time() - $then) / 31556926));
    }

    function url_encode($url = null) {
        return base64_encode(base64_encode(base64_encode($url)));
    }

    function url_decode($url = null) {
        return base64_decode(base64_decode(base64_decode($url)));
    }

    function Datediff($strDate1 = null, $strDate2 = null) {
        return (strtotime($strDate2) - strtotime($strDate1)) / ( 60 * 60 * 24 );  // 1 day = 60*60*24
    }

    function Datediff_day($strDate2 = null) {
        $strDate1 = date("Y-m-d");
        return (strtotime($strDate2) - strtotime($strDate1)) / ( 60 * 60 * 24 );  // 1 day = 60*60*24
    }

}
