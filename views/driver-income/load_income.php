<?php
    $config = new app\models\Config_system();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>รายการ</th>
            <th style=" text-align: center;">ราคา</th>
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
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center;" colspan="3">รวม</td>
            <td style="text-align: right;"><?php echo number_format($sum, 2); ?></td>
        </tr>
    </tfoot>
</table>

