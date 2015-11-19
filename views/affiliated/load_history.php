<style type="text/css">
    table tbody td{ white-space: nowrap;}
    table thead th{ white-space: nowrap;}
</style>
<?php

use yii\helpers\Url;

$config = new app\models\Config_system();
$order = new app\models\OrdersTransportAffiliated();
$assign = new \app\models\AssignAffiliated();
$changwat = new \app\models\Changwat();

function get_customer($cus_id = null) {
    $customer = new app\models\Customer();
    $cs = $customer->find()->where(['cus_id' => $cus_id])->one();
    return $cs['company'];
}
?>

<table class="table table-bordered table-striped" id="history_affiliated">
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสปฏิบัติงาน</th>
            <th>วันที่(ไป - กลับ)</th>
            <th>คนขับ</th>
            <th>สถานที่ส่ง</th>
            <th>เส้นทาง</th>
            <th>ค่าขนสินค้า</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($history as $rs): $i++;
            $assigns = $assign->find()->where(['order_id' => $rs['order_id']])->all();
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php echo $rs['order_id'] ?>
                    <a href="<?php echo Url::to(['orders-transport-affiliated/view', 'id' => $rs['id']]) ?>" target="_blank"><i class="fa fa-eye"></i></a>
                </td>
                <td><?php echo $config->thaidate($rs['order_date_start']) . ' - ' . $config->thaidate($rs['order_date_end']) ?></td>
                <td>
                    <?php
                    echo "- ".$rs['driver1'];
                    if (!empty($rs['driver2'])) {
                        echo "<br/>- ".$rs['driver2'];
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($assigns as $as) {
                        echo "- " . get_customer($as['cus_start']) . ' - ' . get_customer($as['cus_end']) . "<br/>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($assigns as $ass) {
                        ?>

                        <?php
                        echo "- " . $changwat->find()->where(['changwat_id' => $ass['changwat_start']])->one()['changwat_name'];
                        echo "-";
                        echo $changwat->find()->where(['changwat_id' => $ass['changwat_end']])->one()['changwat_name'];
                        echo "<br/>";
                        ?>
    <?php } ?>
                </td>
                <td><?php echo number_format($rs['price_affiliated'], 2) ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#history_affiliated").DataTable();
        $('#history_affiliated').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "scrollX": true,
            "iDisplayLength": 500
        });
    });
</script>
