
<?php

use yii\helpers\Url;
use app\models\Driver;

$customer = new app\models\Customer();
$config = new app\models\Config_system();
$order = new app\models\OrdersTransport();

?>

<table class="table table-bordered table-striped" id="history_repair">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>รายการซ่อม</th>
            <th style=" text-align: center;">ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $sum = 0;
        foreach ($repair_order as $rs): $i++;
        $sum = $sum + $rs['price'];
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $config->thaidate($rs['create_date']) ?></td>
                <td><?php echo $rs['detail'] ?> 
                    <?php if($rs['order_id'] != '0'){ ?>
                    <font style="color:red" class="pull-right"><em>(ระหว่างวิ่งรถ <?php echo $rs['order_id']?>)</em>
                    <?php } ?>
                    </font></td>
                <td style="text-align: right;"><?php echo number_format($rs['price'],2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center;" colspan="3">รวม</td>
            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum,2)?></td>
        </tr>
    </tfoot>
</table>

<script>
    $(function () {
        $("#history_repair").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
