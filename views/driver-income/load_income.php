<?php

use yii\helpers\Url;

$config = new app\models\Config_system();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>รายการ</th>
            <th style=" text-align: center;">ราคา</th>
            <th style=" text-align:  center;">ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sum = 0;
        $i = 0;
        foreach ($income as $rs): $i++;
            $sum = $sum + $rs['price'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $config->thaidate($rs['transport_date']); ?></td>
                <td><?php echo $rs['detail']; ?></td>
                <td style=" text-align: right;"><?php echo number_format($rs['price'], 2); ?></td>
                <td style=" text-align:  center;">
                    <?php if ($rs['type'] == 1) { ?>
                        <a href="javascript:delete_driver_income('<?php echo $rs['id'] ?>')">
                            <i class="fa fa-remove text-red"></i>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center; font-weight: bold;" colspan="3">รวม</td>
            <td style="text-align: right; font-weight: bold;"><?php echo number_format($sum, 2); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    function delete_driver_income(id) {
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
            var url = "<?php echo Url::to(['driver-income/delete_income']) ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                load_income();
            });
            swal("Deleted!", "ลบข้อมูลแล้ว.", "success");
        });


    }
</script>

