
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th style=" text-align: left;">รายการ</th>
            <th>ราคา</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sum = 0;
        $i=0;
        foreach($result as $rs): 
            $i++;
        $sum = $sum + $rs['price'];
        ?>
        <tr>
            <td style=" text-align: center;"><?php echo $i; ?></td>
            <td style=" text-align: left;"><?php echo $rs['detail']?></td>
            <td style=" text-align: right;"><?php echo number_format($rs['price'],2)?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center;" colspan="2">รวม</td>
            <td style=" text-align: right;"><?php echo number_format($sum,2); ?></td>
        </tr>
    </tfoot>
</table>

