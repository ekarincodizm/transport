<?php
    $config = new app\models\Config_system();
?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่บันทึก</th>
            <th>รายการ</th>
            <th style=" text-align: center;">รายรับ</th>
            <th style=" text-align: center;">รายจ่าย</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        $sum_income = 0;
        $sum_expenses = 0;
        foreach ($result as $rs): $i++;
        if ($rs['type'] == '1') {
            $sum_income = $sum_income + $rs['price'];
            $color = "color: #009933;";
        } else {
            $sum_expenses = $sum_expenses + $rs['price'];
            $color = "color: #ff3300;";
        } ?>
        <tr style="<?php echo $color;?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $config->thaidate($rs['transport_date']) ?></td>
                <td><?php echo $rs['detail'] ?></td>
                <td style="text-align: right;">
                    <?php
                    if ($rs['type'] == '1') {
                        echo number_format($rs['price'],2);
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td style="text-align: right;">
                     <?php
                    if ($rs['type'] == '0') {
                        echo number_format($rs['price'],2);
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style=" text-align:  center; font-weight: bold;">รวม</td>
            <td style=" font-weight: bold; text-align: right"><?php echo number_format($sum_income,2)?></td>
            <td style=" font-weight: bold; text-align: right"><?php echo number_format($sum_expenses,2)?></td>
        </tr>
        <tr style=" color: #0000ff;">
            <td colspan="3" style=" text-align:  center; font-weight: bold;">สุทธิ</td>
            <td colspan="2" style=" font-weight: bold; text-align: center"><?php echo number_format($sum_income - $sum_expenses,2)?> บาท</td>
        </tr>
    </tfoot>
</table>

