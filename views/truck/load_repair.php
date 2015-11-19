
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
            <th style=" text-align: center;">ลบ</th>
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
                <td style="text-align: center;">
                    <?php if($rs['type'] == '0'){ ?>
                    <a href="javascript:delete_repair('<?php echo $rs['id']?>');">
                        <i class="fa fa-trash text-red"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center;" colspan="3">รวม</td>
            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum,2)?></td>
            <td></td>
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
    
    function delete_repair(id) {
        //var r = confirm("คุณแน่ใจหรือไม่ ...?");

        swal({
            title: "คุณแน่ใจหรือไม่ ...?",
            text: "คุณต้องการลบรายการนี้ใช่หรือไม่...!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่, ต้องการลบ!",
            closeOnConfirm: false},
        function () {
            var url = "<?php echo Url::to(['repair/delete']) ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                load_repair();
            });
            swal("Deleted!", "ลบข้อมูลแล้ว.", "success");
        });


    }
</script>
