<?php

use yii\helpers\Url;

$changwat = new app\models\Changwat();
$customer = new \app\models\Customer();
$config = new \app\models\Config_system();
?>
<div class="box box-info">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>วันที่</th>
                <th>ใบสั่งงาน</th>
                <th>ลูกค้า</th>
                <th>ระยะทาง</th>
                <th style=" text-align: center;">เบี้ยเลี้ยง</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($result as $rs): $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $config->thaidate($rs['transport_date']); ?></td>
                    <td>
                        <a href="<?php echo Url::to(['order-transport/view', 'id' => $rs['id']]) ?>">
                            <?php echo $rs['assign_id']; ?></a>
                    </td>
                    <td>
                        <?php
                        echo $customer->find()->where(['cus_id' => $rs['cus_start']])->one()->company . ' - ';
                        echo $customer->find()->where(['cus_id' => $rs['cus_end']])->one()->company;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $changwat->find()->where(['changwat_id' => $rs['changwat_start']])->one()->changwat_name . ' - ';
                        echo $changwat->find()->where(['changwat_id' => $rs['changwat_end']])->one()->changwat_name;
                        ?>
                    </td>
                    <td style=" text-align: right;"><?php echo $rs['allowance_driver']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

