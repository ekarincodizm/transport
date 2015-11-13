
<?php
use yii\helpers\Url;
use app\models\Driver;

$customer = new app\models\Customer();
$config = new app\models\Config_system();
$order = new app\models\OrdersTransport();

function get_driver($driver_id = null) {
    $rs = Driver::find()->where(['id' => $driver_id])->one();
    return $rs['name'] . '-' . $rs['lname'];
}
?>

<table class="table table-bordered table-striped" id="history_transport">
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสปฏิบัติงาน</th>
            <th>วันที่(ไป - กลับ)</th>
            <th>คนขับ</th>
            <th style="text-align: center;">ค่าใช่จ่าย(รวมเที่ยวนี้)</th>
            <th style=" text-align: center;">รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($history as $rs): $i++;
            $order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php echo $rs['order_id'] ?>
                </td>
                <td><?php echo $config->thaidate($rs['order_date_start']) . ' - ' . $config->thaidate($rs['order_date_end']) ?></td>
                <td><?php echo get_driver($rs['driver1']) . ' / ' . get_driver($rs['driver2']) ?></td>
                <td style=" text-align: right;"><?php echo number_format($customer->sum_expenses($rs['order_id']),2);?></td>
                <td style=" text-align: center;">
                    <a href="<?php echo Url::to(['customer/detail_transport','id' => $order_id])?>" target="_blank"><i class="fa fa-file-pdf-o"></i> ดูข้อมูล</a>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#history_truck").DataTable();
        $('#history_transport').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
