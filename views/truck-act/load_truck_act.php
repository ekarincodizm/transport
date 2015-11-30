
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $order = new app\models\OrdersTransport();
 */
$config = new app\models\Config_system();
?>

<table class="table table-bordered table-striped" id="tb_truck_act">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่ทำ พรบ./ต่อภาษี</th>
            <th>วันที่ครบกำหนด</th>
            <th>วันที่ทำรายการ</th>
            <th style=" text-align: center;">จำนวน</th>
            <th style="text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($truck_act as $rs): $i++;
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php echo $config->thaidate($rs['act_start']) ?>
                </td>
                <td>
                    <?php echo $config->thaidate($rs['act_end']) ?>
                </td>
                <td>
                    <?php echo $config->thaidate($rs['create_date']) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo number_format($rs['act_price'],2)?>
                </td>
                <td style=" text-align: center;">
                    <a href="javascript:delete_act('<?php echo $rs['id']?>')"><i class="fa fa-trash text-red"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#tb_truck_act').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX" : true
        });
    });
    
    function delete_act(id) {
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
            var url = "<?php echo Url::to(['truck-act/delete']) ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                get_act();
            });
            swal("Deleted!", "ลบข้อมูลแล้ว.", "success");
        });


    }
</script>
