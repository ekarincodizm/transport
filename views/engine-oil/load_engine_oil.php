
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $order = new app\models\OrdersTransport();
 */
$config = new app\models\Config_system();
?>

<table class="table table-bordered table-striped" id="tb_engine">
    <thead>
        <tr>
            <th>#</th>
            <th>ระยะทางที่เข้ารับบริการ(กม.)</th>
            <th>ระยะทางรอบต่อไป(กม.)</th>
            <th>วันที่ทำรายการ</th>
            <th style=" text-align: center;">ราคา</th>
            <th style="text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($engine as $rs): $i++;
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php echo $rs['now_mile'] ?>
                </td>
                <td>
                    <?php echo $rs['next_mile'] ?>
                </td>
                <td>
                    <?php echo $config->thaidate($rs['create_date']) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo number_format($rs['price'],2)?>
                </td>
                <td style=" text-align: center;">
                    <a href="javascript:delete_engin('<?php echo $rs['id']?>')"><i class="fa fa-trash text-red"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#tb_engine').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX" : true
        });
    });
    
    function delete_engin(id) {
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
            var url = "<?php echo Url::to(['engine-oil/delete']) ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                get_engine();
            });
            swal("Deleted!", "ลบข้อมูลแล้ว.", "success");
        });


    }
</script>
