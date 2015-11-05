<?php

use yii\helpers\Url;
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>ทะเบียนรถ</th>
            <th>รายการ</th>
            <th style="text-align: right;">ราคา</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $sum = 0;
        foreach ($result as $rs): $i++;
            $id = $rs->id;
            $sum = $sum + $rs->price;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rs->truck_license; ?></td>
                <td><?php echo $rs->detail; ?></td>
                <td style="text-align: right;"><?php echo number_format($rs->price); ?></td>
                <td>
                    <a href="javascript:delete_expenses('<?php echo $id ?>')" title="ลบ">
                        <i class="fa fa-remove text-red"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr style=" color: #ff3300; font-weight: bold;">
            <td colspan="3" style="text-align: center;">รวม</td>
            <td style="text-align: right;">
                <input type="hidden" id="expenese_truck_total" value="<?php echo $sum; ?>"/>
                <?php echo number_format($sum); ?>
            </td>
            <td></td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    function delete_expenses(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        if (r == true) {
            $("#e-ding").show();
            var url = "<?php echo Url::to(['expenses-truck/delete']) ?>";
            var data = {id: id};

            $.post(url, data, function (success) {
                $("#e-ding").hide();
                load_expenses();
            });
        }

    }
</script>