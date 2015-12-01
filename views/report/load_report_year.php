<style type="text/css">
    table thead tr th{ text-align: center;background: #999999; color: #FFF;}
    table tbody tr td{ text-align: right;}
    table tfoot tr td{ text-align: right; font-weight: bold; background: #999999; color: #FFF;}
    #income{ background: #006633; color: yellow; font-weight: bold;}
    #outcome{ background: #cc0033; color: #ffffff; font-weight: bold;}
    #total{ background: #0000cc; font-weight: bold;}
</style>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$config = new app\models\Config_system();
?>
<b>สรุปยอด (กำไร - ขาดทุก) ปี พ.ศ. <?php echo ($year + 543)?></b>
<div class="table table-responsive">
<table class="table table-striped table-hover" id="report_year">
    <thead>
        <tr>
            <th rowspan="2" valign="middle"><i class="fa fa-calendar"></i><br/>เดือน</th>
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
            <th>ซ่อมรถ</th>
            <th>จ่ายพนักงาน</th>
            <th>ค่างวด</th>
            <th>ภาษี/พรบ.</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $sum_expenses_row = 0;
        $sum_total_row = 0;
        $sum_income = 0;
        $sum_outcome = 0;
        foreach ($report as $rs):
            $sum_expenses_row = ($rs['oil_price'] + $rs['gas_price'] + $rs['expenses_around'] + $rs['fix_truck'] + $rs['income_driver'] + $rs['truck_period'] + $rs['truck_act']);
            $sum_total_row = ($rs['income'] - $sum_expenses_row);
            
            $sum_income = $sum_income + $rs['income'];
            $sum_outcome = $sum_outcome + $sum_expenses_row;
            if(substr($sum_total_row,0,1) == '-'){
                $style = "color:red;";
            } else {
                $style = "color:white";
            }
            ?>
        <tr>
                <th><?php echo $rs['month_th'] ?></th>
                <td><?php echo number_format($rs['around']) ?></td>
                <td><?php echo number_format($rs['distance']) ?></td>
                <td><?php echo number_format($rs['oil']) ?></td>
                <td><?php echo number_format($rs['gas']) ?></td>
                <td id="income"><?php echo number_format($rs['income'],2) ?></td>
                <td><?php echo number_format($rs['oil_price'],2) ?></td>
                <td><?php echo number_format($rs['gas_price'],2) ?></td>
                <td><?php echo number_format($rs['expenses_around'],2) ?></td>
                <td><?php echo number_format($rs['fix_truck'],2) ?></td>
                <td><?php echo number_format($rs['income_driver'],2) ?></td>
                <td><?php echo number_format($rs['truck_period'],2) ?></td>
                <td><?php echo number_format($rs['truck_act'],2) ?></td>
                <td id="outcome"><?php echo number_format($sum_expenses_row, 2) ?></td>
                <td id="total" style="<?php echo $style;?>"><?php echo number_format($sum_total_row, 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style=" text-align: center;">รวม</td>
            <td><?php echo number_format($sum_income,2); ?></td>
            <td colspan="7"></td>
            <td><?php echo number_format($sum_outcome,2); ?></td>
            <td><?php echo number_format($sum_income - $sum_outcome,2); ?></td>
        </tr>
    </tfoot>
</table>
</div>

