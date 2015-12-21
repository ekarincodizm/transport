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

function get_driver($car_id = null) {
    $mapdriver = new \app\models\MapDriver();
    $rs = $mapdriver->find()->where(['car_id' => $car_id, 'active' => '1'])->one();
    $driver_id = $rs['driver'];
    $result = $mapdriver->get_driver($driver_id);
    return $result;
}

function Affiliated_truck($truck_id = null) {
    $Affiliated = new \app\models\AffiliatedTruck();
    $result = $Affiliated->find()->where(['id' => $truck_id])->one();
    return $result['license_plate'];
}
?>
<b>รายรับ รายจ่าย รายการขนส่งประจำเดือน <?php echo $monthfull[$month] . " " . ($year + 543); ?></b>

<div class="table table-responsive">
    <table class="table table-striped table-hover table-bordered" id="report_year">
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
                //Config 
                $outgoing = $report->sum_get_outgoing($year, $month, $rs['car_id']); //ค่าใช้จ่ายเกี่ยวกับการวิ่งทะเบียนนี
                $expenses_truck = $report->sum_expenses_truck($year, $month, $rs['car_id']); //ค่าใช้จ่ายเกี่ยวกับรถ 
                $salary = $report->sum_salary($year, $month, $rs['car_id']); //เงินเดือนพนักงานและรายได้คนขับคันนี้
                $annuities = $report->sum_annuities($year, $month, $rs['car_id']); //ค่างวดรถ
                $truck_act = $report->sum_truck_act($year, $month, $rs['car_id']); //ค่าต่อทะเบียน พรบ.
                $sum_expenses_row = ((int) $outgoing + (int) $expenses_truck + (int) $salary + (int) $annuities + (int) $truck_act); //รวมค่าใช้จ่าย

                $allowance_driver = ((int) $rs['allowance_driver1'] + (int) $rs['allowance_driver2']); //รวมเบี้ยเลี้ยง 2 คน
                $sum_total_row = ($rs['income'] - $sum_expenses_row);
                $sum_income = $sum_income + $rs['income'];
                $sum_outcome = $sum_outcome + $sum_expenses_row;
                ?>
                <tr>
                    <th><?php echo $rs['truck_1'] . ' ' . $rs['truck_2'] ?></th>
                    <td><?php echo get_driver($rs['car_id']) ?></td>
                    <td style=" text-align: center;"><?php echo $report->get_around($year, $month, $rs['car_id']) ?></td>
                    <td><?php echo number_format($rs['distance']) ?></td>
                    <td><?php echo number_format($rs['oil']) ?></td>
                    <td><?php echo number_format($rs['gas']) ?></td>
                    <td id="income"><?php echo number_format($rs['income'], 2) ?></td>

                    <td><?php echo number_format($rs['oil_price'], 2) ?></td>
                    <td><?php echo number_format($rs['gas_price'], 2) ?></td>
                    <td><?php echo number_format($outgoing, 2) ?> <a href="javascript:get_sub_outgoing('<?php echo $rs['car_id'] ?>')"><i class="fa fa-list text-green"></i></a></td>
                    <td><?php echo number_format($expenses_truck, 2) ?> <a href="javascript:get_sub_expenses_truck('<?php echo $rs['car_id'] ?>')"><i class="fa fa-list text-green"></i></a></td>
                    <td><?php echo number_format($salary, 2) ?> <a href="javascript:get_sub_salary('<?php echo $rs['car_id'] ?>')"><i class="fa fa-list text-green"></i></a></td>
                    <td><?php echo number_format($annuities, 2) ?> <a href="javascript:get_sub_annuities('<?php echo $rs['car_id'] ?>')"><i class="fa fa-list text-green"></i></a></td>
                    <td><?php echo number_format($truck_act, 2) ?> <a href="javascript:get_sub_truck_act('<?php echo $rs['car_id'] ?>')"><i class="fa fa-list text-green"></i></a></td>
                    <td id="outcome"><?php echo number_format($sum_expenses_row, 2) ?></td>
                    <td id="total" style=""><?php echo number_format($sum_total_row, 2) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php
            $sumincom_out_transport = 0;
            foreach ($order_out as $o):
                $sumincom_out_transport = $sumincom_out_transport + $o['income_total'];
                ?>
                <tr>
                    <td colspan="6" style=" text-align: left;">
                        จ้างรถร่วมวิ่ง ทะเบียน(<?php echo Affiliated_truck($o['truck1']) . ' ' . Affiliated_truck($o['truck2']) ?>) 
                        คนขับ (<?php echo $o['driver1'] . ' ' . $o['driver2'] ?>)
                    </td>
                    <td style="text-align: right;" id="income"><?php echo number_format($o['income_total'], 2) ?></td>
                    <td colspan="7"></td>
                    <td id="outcome">0</td>
                    <td style="text-align: right;" id="total"><?php echo number_format($o['income_total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style=" text-align: center;">รวม</td>
                <td><?php echo number_format(($sum_income + $sumincom_out_transport), 2); ?></td>
                <td colspan="7"></td>
                <td><?php echo number_format($sum_outcome, 2); ?></td>
                <td><?php echo number_format(($sum_income + $sumincom_out_transport) - $sum_outcome, 2); ?></td>
            </tr>
        </tfoot>
    </table>

</div>

<!-- 
    # Dialog get sub 
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popup_sub_expenses">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">รายละเอียด</h4>
            </div>
            <div class="modal-body">
                <div id="result_sub_report"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function get_sub_outgoing(car_id) {
        $("#popup_sub_expenses").modal();
        var url = "<?php echo Url::to(['report/get_sub_outgoing']) ?>";
        var year = "<?php echo $year ?>";
        var month = "<?php echo $month ?>";
        var data = {year: year, month: month, car_id: car_id};

        $.post(url, data, function (result) {
            $("#result_sub_report").html(result);
        });
    }

    function get_sub_expenses_truck(car_id) {
        $("#popup_sub_expenses").modal();
        var url = "<?php echo Url::to(['report/get_sub_expenses_truck']) ?>";
        var year = "<?php echo $year ?>";
        var month = "<?php echo $month ?>";
        var data = {year: year, month: month, car_id: car_id};

        $.post(url, data, function (result) {
            $("#result_sub_report").html(result);
        });
    }

    function get_sub_salary(car_id) {
        $("#popup_sub_expenses").modal();
        var url = "<?php echo Url::to(['report/get_sub_salary']) ?>";
        var year = "<?php echo $year ?>";
        var month = "<?php echo $month ?>";
        var data = {year: year, month: month, car_id: car_id};

        $.post(url, data, function (result) {
            $("#result_sub_report").html(result);
        });
    }

    function get_sub_annuities(car_id) {
        $("#popup_sub_expenses").modal();
        var url = "<?php echo Url::to(['report/get_annuities']) ?>";
        var year = "<?php echo $year ?>";
        var month = "<?php echo $month ?>";
        var data = {year: year, month: month, car_id: car_id};

        $.post(url, data, function (result) {
            $("#result_sub_report").html(result);
        });
    }

    function get_sub_truck_act(car_id) {
        $("#popup_sub_expenses").modal();
        var url = "<?php echo Url::to(['report/get_truck_act']) ?>";
        var year = "<?php echo $year ?>";
        var month = "<?php echo $month ?>";
        var data = {year: year, month: month, car_id: car_id};

        $.post(url, data, function (result) {
            $("#result_sub_report").html(result);
        });
    }
</script>
