<style type="text/css">
    table thead tr th{ text-align: center;background: #999999; color: #FFF;}
    table tbody tr td{ text-align: right;}
    table tfoot tr td{ text-align: right; font-weight: bold; background: #999999; color: #FFF;}
    #income{ background: #006633; color: yellow; font-weight: bold;}
    #outcome{ background: #cc0033; color: #ffffff; font-weight: bold;}
    #total{ background: #0000cc; font-weight: bold; color: #FFF;}
</style>


<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

//use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$config = new app\models\Config_system();
$report = new \app\models\Report();
$monthfull = $config->MonthFullKey();
?>
<b>รายรับ รายจ่าย รายการขนส่งประจำเดือน <?php echo $monthfull[$month]." ".($year + 543); ?></b>

<div class="table table-responsive">
    <table class="table table-striped table-hover" id="report_year">
        <thead>
            <tr>
                <th rowspan="2" valign="middle"><i class="fa fa-calendar"></i><br/>ทะเบียน</th>
                <th rowspan="2" valign="middle"><i class="fa fa-user"></i><br/>คนขับประจำ</th>
                <th rowspan="2" valign="middle"><i class="fa fa-truck"></i><br/>จำนวนรอบ</th>
                <th rowspan="2" valign="middle">ระยะทาง<br/>(ก.ม)</th>
                <th rowspan="2" valign="middle">น้ำมัน<br/>(ลิตร)</th>
                <th rowspan="2" valign="middle">แก๊ส<br/>(ก.ก.)</th>
                <th rowspan="2" id="income" style=" text-align: center; color: #FFF;">รายรับ</th>
                <th colspan="7" style=" text-align: center;" valign="middle">รายจ่าย</th>
                <th id="outcome" rowspan="2" style=" text-align: center; font-weight: bold;" valign="middle">รวมรายจ่าย</th>
                <th id="total" rowspan="2" style=" text-align: center; color: #FFF;" valign="middle">คงเหลือ</th>
            </tr>
            <tr>
                <th>น้ำมัน</th>
                <th>แก๊ส</th>
                <th>คชจ.การเดินทาง</th>
                <th>คชจ.ซ่อมรถ</th>
                <th>คชจ.พนักงาน</th>
                <th>ค่างวดรถ</th>
                <th>ภาษี/พรบ.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $sum_expenses_row = 0; //รวมรายจ่าย
            $sum_total_row = 0; //คงเหลือ
            $sum_income = 0; //รวมรายรับ
            $sum_outcome = 0; //รวมรายจ่าย
            foreach ($result as $rs):
                $i++;
                $allowance_driver = ((int) $rs['allowance_driver1'] + (int) $rs['allowance_driver2']); //รวมเบี้ยเลี้ยง 2 คน
                $sum_total_row = ($rs['income'] - $sum_expenses_row);
                $sum_income = $sum_income + $rs['income'];
                $sum_outcome = $sum_outcome + $sum_expenses_row;
                ?>
                <tr>
                    <th><?php echo $rs['truck_1'] . ' ' . $rs['truck_2'] ?></th>
                    <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                    <td><?php echo $report->get_around($year,$month,$rs['car_id']) ?></td>
                    <td><?php echo number_format($rs['distance']) ?></td>
                    <td><?php echo number_format($rs['oil']) ?></td>
                    <td><?php echo number_format($rs['gas']) ?></td>
                    <td id="income"><?php echo number_format($rs['income'], 2) ?></td>
                    
                    <td><?php echo number_format($rs['oil_price'], 2) ?></td>
                    <td><?php echo number_format($rs['gas_price'], 2) ?></td>
                    <td><?php echo number_format($report->sum_get_outgoing($year, $month, $rs['car_id']), 2) ?><i class="fa fa-eye"></i></td>
                    <td><?php echo number_format($report->sum_expenses_truck($year, $month, $rs['car_id']), 2) ?><i class="fa fa-eye"></i></td>
                    <td><?//php echo number_format($rs['income_driver'], 2) ?></td>
                    <td><?//php echo number_format($rs['truck_period'], 2) ?></td>
                    <td><?//php echo number_format($rs['truck_act'], 2) ?></td>
                    <td id="outcome"><?php echo number_format($sum_expenses_row, 2) ?></td>
                    <td id="total" style=""><?php echo number_format($sum_total_row, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style=" text-align: center;">รวม</td>
                <td><?php echo number_format($sum_income, 2); ?></td>
                <td colspan="7"></td>
                <td><?php echo number_format($sum_outcome, 2); ?></td>
                <td><?php echo number_format($sum_income - $sum_outcome, 2); ?></td>
            </tr>
        </tfoot>
    </table> 

</div>


