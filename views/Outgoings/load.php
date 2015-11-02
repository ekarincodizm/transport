<?php

use yii\helpers\Url;
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
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
                <td><?php echo $rs->detail; ?></td>
                <td style="text-align: right;"><?php echo number_format($rs->price); ?></td>
                <td>
        <center>
            <a href="javascript:delete_outgoings('<?php echo $id ?>')" title="ลบ">
                <i class="fa fa-remove text-red"></i>
            </a>
        </center>
    </td>
    </tr>
<?php endforeach; ?>
</tbody>
<tfoot>
    <tr style=" color: #ff3300; font-weight: bold;">
        <td colspan="2" style="text-align: center;">รวม</td>
        <td style="text-align: right;"><?php echo number_format($sum); ?></td>
        <td></td>
    </tr>
</tfoot>
</table>

<script type="text/javascript">
    function delete_outgoings(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        if (r == true) {
            $("#l-ding").show();
            var url = "<?php echo Url::to(['outgoings/delete']) ?>";
            var data = {id: id};

            $.post(url, data, function (success) {
                $("#l-ding").hide();
                load_outgoings();
            });
        }

    }
</script>