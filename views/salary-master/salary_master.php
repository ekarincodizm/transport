<?php

use yii\helpers\Url;
use app\models\Config_system;

$config = new Config_system();
?>

<?php if (!empty($model)) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th style=" text-align: center;">วันที่ปรับเงินเดือน</th>
                <th style=" text-align: right;">จำนวนเงิน</th>
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
                    <td style=" text-align: center;"><?php echo $config->thaidate($rs['update_salary']); ?></td>
                    <td style=" text-align: right;"><?php echo number_format($rs['salary']); ?></td>
                    <td style=" text-align: center;">
                        <?php if ($rs['active'] == '1') { ?>
                            <input type="radio" name="active" id="active" checked="checked"/>
                        <?php } else { ?>
                            <input type="radio" name="active" id="active" onclick="set_salary('<?php echo $rs['id'] ?>', '<?php echo $rs['salary'] ?>')"/>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } else { ?>
    <center>ยังไม่ได้กำหนดเงินเดือน</center>
<?php } ?>

<script type="text/javascript">
    function set_salary(id) {
        var url = "<?php echo Url::to(['salary-master/set_salary']) ?>";
        var employee = $("#employee").val();
        var data = {id: id, employee: employee};
        $.post(url, data, function (datas) {
            $("#salary_price").val(datas.salary);
            $("#dialog_salary_master").modal("hide");
        },'json');
    }
</script>

