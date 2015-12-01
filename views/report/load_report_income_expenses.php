<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = "รายงาน (รายรับ - รายจ่าย)";
$this->params['breadcrumbs'][] = $this->title;

$config = new app\models\Config_system();
?>


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>จำนวนรอบ</th>
            <th>ระยะทาง(ก.ม)</th>
            <th>น้ำมัน(ลิตร)</th>
            <th>รายรับ</th>
            <th>รายจ่าย</th>
            <th>น้ำมัน</th>
            <th>คชจ.การเดินทาง</th>
            <th>ซ่อมใน</th>
            <th>ซ่อมนอก</th>
            <th>คชจ.ส่วนกลาง</th>
            <th>รวมรายจ่าย</th>
            <th>รายรับ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($type as $types): ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

