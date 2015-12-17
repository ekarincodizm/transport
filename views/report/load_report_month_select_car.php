<style type="text/css">
    table thead tr th{ text-align: center;background: #999999; color: #FFF; white-space: nowrap;}
    table tbody tr td{ white-space: nowrap;}
</style>
<?php

use yii\helpers\Url;
use app\models\Driver;

$customer = new app\models\Customer();
$config = new app\models\Config_system();
$order = new app\models\OrdersTransport();

$monthFull = $config->MonthFullKey();
?>


<table class="table table-bordered table-striped table-responsive" id="tb_load_price">
    <thead>
        <tr>
            <th colspan="4" style="text-align: center;">
                บัญชีค่าใช้จ่ายของรถประจำเดือน
            </th>
        </tr>
        <tr>
            <th colspan="4">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4" style=" text-align: center;">
                        ทะเบียนรถ <?php echo $car['truck_1'] . ' ' . $car['truck_2'] ?>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4" style="text-align: center;">
                        คนขับประจำ <?php echo $driver['name'] . ' ' . $driver['lname'] ?>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4" style=" text-align: center;">
                        ประจำเดือน <?php echo $monthFull[$month] . ' ' . ($year + 543); ?>
                    </div>
                </div>


            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>รายการ</th>
            <th style=" text-align: center;">ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $sum = 0;
        foreach ($result as $rs): $i++;
            $sum = $sum + $rs['price'];
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $config->thaidate($rs['create_date']) ?></td>
                <td><?php echo $rs['detail'] ?> 
                    <?php if ($rs['order_id'] != '0') { ?>
                        <font style="color:red" class="pull-right"><em>(ระหว่างวิ่งรถ <?php echo $rs['order_id'] ?>)</em>
                    <?php } ?>
                    </font></td>
                <td style="text-align: right;"><?php echo number_format($rs['price'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center;" colspan="3">รวม</td>
            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum, 2) ?></td>
        </tr>
    </tfoot>
</table>

<script>
    $(function () {
        //$("#tb_load_price").DataTable();
        $('#tb_load_price').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true
        });
    });

</script>

<button type="button" class="btn btn-info btn-xs" onclick="javascript:$('#query').modal()"><i class="fa fa-info"></i>Query</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="query">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Query</h4>
            </div>
            <div class="modal-body">
                <pre>
                    #$year = ปี
                    #$month = เดือน
                    #car_id = รถคันที่

                    //ข้อมูลการซ่อมของทะเบียนรถคันที่ 1
                    (
                    SELECT o.id,o.create_date,
                        CONCAT(o.detail,' (ทะเบียน ',t.truck_1,')') AS detail,
                        o.price,'0' AS order_id,'0' AS type
                    FROM `repair` o INNER JOIN map_truck t ON o.truck_license = t.truck_1
                    WHERE t.car_id = '$car_id' 
                        AND LEFT(o.create_date,4) = '$year'
                        AND SUBSTR(o.create_date,6,2) = '$month'
                    ORDER BY o.id DESC
                    )

                    UNION 
                    //ข้อมูลการซ่อมของทะเบียนรถคันที่ 2            
                    (
                    SELECT o.id,o.create_date,
                        CONCAT(o.detail,' (ทะเบียน ',t.truck_2,')') AS detail,
                        o.price,'0' AS order_id,'0' AS type
                    FROM `repair` o INNER JOIN map_truck t ON o.truck_license = t.truck_2
                    WHERE t.car_id = '$car_id' 
                        AND LEFT(o.create_date,4) = '$year'
                        AND SUBSTR(o.create_date,6,2) = '$month'
                    ORDER BY o.id DESC
                    )

                    UNION
                    //ข้อมูลการซ่อมระหว่างรถวิ่งคันที่ 1  
                    (
                    SELECT e.id,e.create_date,
                        CONCAT(e.detail,' (ทะเบียน ',e.truck_license,')') AS detail,
                        e.price,e.assign_id AS order_id,'1' AS type
                    FROM expenses_truck e INNER JOIN map_truck t ON e.truck_license = t.truck_1 
                    WHERE t.car_id = '$car_id' 
                        AND LEFT(e.create_date,4) = '$year'
                        AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                    )

                    UNION
                    //ข้อมูลการซ่อมระหว่างรถวิ่งคันที่ 2
                    (
                    SELECT e.id,e.create_date,
                        CONCAT(e.detail,' (ทะเบียน ',e.truck_license,')') AS detail,
                        e.price,e.assign_id AS order_id,'1' AS type
                    FROM expenses_truck e INNER JOIN map_truck t ON e.truck_license = t.truck_2
                    WHERE t.car_id = '$car_id' 
                        AND LEFT(e.create_date,4) = '$year'
                        AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                    )

                    UNION
                    //ข้อมูลการต่อภาษี รถคันที่ 1
                    (
                    SELECT e.id,e.create_date,
                        CONCAT('ค่าต่อทะเบียน/พรบ./ภาษีประจำปี (ทะเบียน ',t.truck_1,')') AS detail,
                        e.act_price AS price,'0' AS order_id,'0' AS type
                    FROM truck_act e INNER JOIN map_truck t ON e.license_plate = t.truck_1
                    WHERE t.car_id = '$car_id' 
                        AND LEFT(e.create_date,4) = '$year'
                        AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                    )

                    UNION
                    //ข้อมูลการต่อภาษี รถคันที่ 2
                    (
                    SELECT e.id,e.create_date,
                        CONCAT('ค่าต่อทะเบียน/พรบ./ภาษีประจำปี (ทะเบียน ',t.truck_2,')') AS detail,
                        e.act_price AS price,'0' AS order_id,'0' AS type
                    FROM truck_act e INNER JOIN map_truck t ON e.license_plate = t.truck_2
                    WHERE t.car_id = '$car_id' 
                        AND LEFT(e.create_date,4) = '$year'
                        AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                    )

                    UNION
                    //ข้อมูลค่างวดรถคัน 1
                    (
                    SELECT e.id,e.create_date,
                        CONCAT('จ่ายค่างวดรถ งวดวันที่ ',e.`day`,'/',e.`month`,'/',e.`year`,' (ทะเบียน',m.truck_1,')') AS detail,
                        e.period_price AS price,
                        '0' AS order_id,
                        '0' AS type
                    FROM annuities e INNER JOIN map_truck m ON e.license_plate = m.truck_1
                    WHERE m.car_id = '$car_id'
                        AND LEFT(e.create_date,4) = '$year'
                        AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                    )

                    UNION
                    //ข้อมูลค่างวดรถคัน 2
                    (
                    SELECT e.id,e.create_date,
                        CONCAT('จ่ายค่างวดรถ งวดวันที่ ',e.`day`,'/',e.`month`,'/',e.`year`,' (ทะเบียน',m.truck_2,')') AS detail,
                        e.period_price AS price,
                        '0' AS order_id,
                        '0' AS type
                    FROM annuities e INNER JOIN map_truck m ON e.license_plate = m.truck_2
                    WHERE m.car_id = '$car_id'
                        AND LEFT(e.create_date,4) = '$year'
                        AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                    )

                    UNION

                    (
                    SELECT o.id,o.order_date_start AS create_date,
                        CONCAT('เติมน้ำมัน (ทะเบียน',t.truck_1,')') AS detail,
                        o.oil_price AS price,o.assign_id AS order_id,'0' AS type
                    FROM assign o INNER JOIN map_truck t ON o.car_id = t.car_id
                    WHERE t.car_id = '$car_id'
                        AND o.oil_price != ''
                        AND LEFT(o.order_date_start,4) = '$year'
                        AND SUBSTR(o.order_date_start,6,2) = '$month'
                    ORDER BY o.id DESC
                    )

                    UNION 

                    (
                    SELECT o.id,o.order_date_start AS create_date,
                        CONCAT('เติมแก๊ส (ทะเบียน',t.truck_1,')') AS detail,
                        o.gas_price AS price,o.assign_id AS order_id,'0' AS type
                    FROM assign o INNER JOIN map_truck t ON o.car_id = t.car_id
                    WHERE t.car_id = '$car_id'
                        AND o.gas_price != ''
                        AND LEFT(o.order_date_start,4) = '$year'
                        AND SUBSTR(o.order_date_start,6,2) = '$month'
                    ORDER BY o.id DESC
                    )

                    ORDER BY create_date ASC
                </pre>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
