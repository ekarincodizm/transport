<style type="text/css">
    table thead tr th{ text-align: center;background: #999999; color: #FFF; font-weight: normal; white-space: nowrap;}
    table tbody tr td{ text-align: right; white-space: nowrap;}
    table tbody tr th{ white-space: nowrap;}
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
<b>รายรับ รายจ่าย รายการขนส่งประจำปี <?php echo ($year + 543); ?></b>
<?//php echo $chart; ?>
<div class="table table-responsive">
    <table class="table table-striped table-hover table-bordered" id="report_year">
        <thead>
            <tr>
                <th rowspan="2" valign="middle"><i class="fa fa-calendar"></i><br/>เดือน</th>
                <th rowspan="2" valign="middle"><i class="fa fa-truck"></i><br/>จำนวนรอบ</th>
                <th rowspan="2" valign="middle">ระยะทาง<br/>(ก.ม)</th>
                <th rowspan="2" valign="middle">น้ำมัน<br/>(ลิตร)</th>
                <th rowspan="2" valign="middle">แก๊ส<br/>(ก.ก.)</th>
                <th rowspan="2" id="income" style=" text-align: center; color: #FFF;">รายรับ</th>
                <th colspan="8" style=" text-align: center;" valign="middle">รายจ่าย</th>
                <th id="outcome" rowspan="2" style=" text-align: center; font-weight: bold;" valign="middle">รวมรายจ่าย</th>
                <th id="total" rowspan="2" style=" text-align: center; color: #FFF;" valign="middle">คงเหลือ</th>
            </tr>
            <tr>
                <th>น้ำมัน</th>
                <th>แก๊ส</th>
                <th>คชจ.การเดินทาง</th>
                <th>คชจ.ซ่อมรถ</th>
                <th>คชจ.พนักงาน</th>
                <th>เปลี่ยนน้ำมันเครื่อง</th>
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
                $sub = $report->Subreport_year($year, $rs['MONTH']);
                //รายได้จากการจ้างขน
                $income_out_transport = $report->sum_income_out_transport_month($year, $rs['MONTH']);
                //$income_out_transport = 0;
                //Config 
                $outgoing = $report->sum_get_outgoing_month($year, $rs['MONTH']); //ค่าใช้จ่ายเกี่ยวกับการวิ่งทะเบียนนี
                $expenses_truck = $report->sum_expenses_truck_month($year, $rs['MONTH']); //ค่าใช้จ่ายเกี่ยวกับรถ 
                $salary = $report->sum_salary_month($year, $rs['MONTH']); //เงินเดือนพนักงานและรายได้คนขับคันนี้
                $engine_oil= $report->sum_engine_oil_month($year, $rs['MONTH']); //เปลี่ยนน้ำมันเครื่อง
                $annuities = $report->sum_annuities_month($year, $rs['MONTH']); //ค่างวดรถ
                $truck_act = $report->sum_truck_act_month($year, $rs['MONTH']); //ค่าต่อทะเบียน พรบ.
                $sum_expenses_row = ((int) $outgoing + (int) $expenses_truck + (int) $salary + (int)$engine_oil + (int) $annuities + (int) $truck_act); //รวมค่าใช้จ่าย

                $allowance_driver = ((int) $sub['allowance_driver1'] + (int) $sub['allowance_driver2']); //รวมเบี้ยเลี้ยง 2 คน
                $sum_total_row = ($sub['income'] - $sum_expenses_row);
                $sum_income = $sum_income + ($sub['income'] + $income_out_transport);
                $sum_outcome = $sum_outcome + $sum_expenses_row;
                ?>
                <tr>
                    <th><?php echo $rs['month_th'] ?></th>
                    <td style=" text-align: center;"><?php echo $report->get_around_month($year, $rs['MONTH']) ?></td>
                    <td><?php echo number_format($sub['distance']) ?></td>
                    <td><?php echo number_format($sub['oil']) ?></td>
                    <td><?php echo number_format($sub['gas']) ?></td>
                    <td id="income"><?php echo number_format(($sub['income'] + $income_out_transport), 2) ?></td>

                    <td><?php echo number_format($sub['oil_price'], 2) ?></td>
                    <td><?php echo number_format($sub['gas_price'], 2) ?></td>
                    <td><?php echo number_format($outgoing, 2) ?></td>
                    <td><?php echo number_format($expenses_truck, 2) ?></td>
                    <td><?php echo number_format($salary, 2) ?></td>
                     <td><?php echo number_format($engine_oil, 2) ?></td>
                    <td><?php echo number_format($annuities, 2) ?></td>
                    <td><?php echo number_format($truck_act, 2) ?></td>
                    <td id="outcome"><?php echo number_format($sum_expenses_row, 2) ?></td>
                    <td id="total" style=""><?php echo number_format($sum_total_row, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style=" text-align: center;">รวม</td>
                <td><?php echo number_format($sum_income, 2); ?></td>
                <td colspan="8"></td>
                <td><?php echo number_format($sum_outcome, 2); ?></td>
                <td><?php echo number_format($sum_income - $sum_outcome, 2); ?></td>
            </tr>
        </tfoot>
    </table>

</div>

