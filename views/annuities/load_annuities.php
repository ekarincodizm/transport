
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $config = new app\models\Config_system();
  $order = new app\models\OrdersTransport();
 */
$config = new app\models\Config_system();
$notify = new \app\models\Notifications();
$month_full = $config->MonthFullKey();
?>
<div class="box box-danger">
    <div class="box-header with-border" style=" color: #ff3300;">
        <i class="fa fa-info"></i> ระบบจะแจ้งเตือนก่อน <?php echo $notify->find()->one()['truck_period'] ?> วัน ในเดือนปัจจุบัน
    </div>
    <div class="box-body">
        <table class="table table-striped table-bordered" id="list_annuities">
            <thead>
                <tr>
                    <th style=" text-align: center;">#</th>
                    <th style=" text-align: center;">กำหนดจ่าย</th>
                    <th>ประจำเดือน</th>
                    <th>ประจำปี</th>
                    <th>ค่างวด</th>
                    <th>วันที่บันทึก</th>
                    <?php if ($flag_period == 0) { ?>
                        <th style="text-align: center;">เลือก</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $rs): $i++;
                    //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i; ?></td>
                        <th style="text-align: center;"><?php echo $rs['day'] ?></th>
                        <td><?php echo $month_full[$rs['month']] ?></td>
                        <td><?php echo ($rs['year'] + 543) ?></td>
                        <td><?php echo number_format($rs['period_price']) ?></td>
                        <td><?php echo $config->thaidate($rs['create_date']) ?></td>
                        <?php if ($flag_period == 0) { ?>
                            <td style=" text-align: center;">
                                <a href="javascript:delete_annuities('<?php echo $rs['id'] ?>')">
                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#list_annuities').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true
        });
    });

    function delete_annuities(id) {
        swal({title: "คุณแน่ใจหรือไม่ ...?", text: "คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่!", type: "warning", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "ใช่, ต้องการลบ!", closeOnConfirm: false},
                function () {
                    var url = "<?php echo Url::to(['annuities/delete']) ?>";
                    var data = {id: id};

                    $.post(url, data, function (success) {
                        swal("Deleted!", "ลบข้อมูลของคุณแล้ว...", "success");
                        get_annuities();
                        return false;
                    });

                });
    }
</script>


