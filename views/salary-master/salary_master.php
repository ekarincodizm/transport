<?php 
    use yii\helpers\Url;
    use app\models\Config_system;
    
    $config = new Config_system();
?>

<?php if(!empty($model)){ ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่ปรับเงินเดือน</th>
            <th>จำนวนเงิน</th>
            <th style=" text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($model as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $config->thaidate($rs['update_salary']); ?></td>
                <td><?php echo $rs['salary']; ?></td>
                <td style=" text-align: center;">
                    <?php if ($rs['active'] == '1') { ?>
                        <input type="radio" name="active" id="active" checked="checked"/>
                    <?php } else { ?>
                        <input type="radio" name="active" id="active" onclick="set_salary('<?php echo $rs['id']?>')"/>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php } else {?>
<center>ยังไม่ได้กำหนดเงินเดือน</center>
<?php } ?>

<script type="text/javascript">
    function set_salary(id){
        var url = "<?php echo Url::to(['salary-master/set_salary'])?>";
        var data = {id: id};
        
        $.post(url,data,function(success){
            load_salary_master();
        });
    }
</script>

