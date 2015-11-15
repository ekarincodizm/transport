<?php

use yii\helpers\Url;
?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>ปี</th>
            <th>เดือน</th>
            <th style=" text-align: right;">เงินเดือน</th>
            <th style=" text-align:  center;">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($salary as $rs):
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo ($rs['year'] + 543) ?></td>
                <td><?php echo $rs['month_th'] ?></td>
                <td style=" text-align: right;"><?php echo number_format($rs['salary']) ?></td>
                <td style=" text-align:  center;">
                    <a href="javascript:delete_salary('<?php echo $rs['id'] ?>')">
                        <i class="fa fa-remove text-red"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function delete_salary(id) {
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
            var url = "<?php echo Url::to(['salary/delete_salary']) ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                load_salary();
            });
            swal("Deleted!", "ลบข้อมูลแล้ว.", "success");
        });


    }
</script>

