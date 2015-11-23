
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $order = new app\models\OrdersTransport();
 */

$this->title = "แจ้งเตือนค่างวดรถ ";
//$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$config = new app\models\Config_system();
$notifications = new \app\models\Notifications();
$notify = $notifications->find()->one();
?>
<label style=" color: #ff3300;">
    * ระบบจะแจ้งเตือนก่อน <?php echo $notify->truck_period; ?> วัน
</label>

<div class="box box-danger">
    <div class="box-header with-border">
        <?php echo $this->title; ?>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped" id="tb_notification_over">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ทะเบียนรถ</th>
                    <th>งวดสุดท้ายที่จ่าย</th>
                    <th>งวด ณ ปัจจุบัน</th>
                    <th>สถานะ</th>
                    <th style="text-align: center;">เลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($notification as $rs): $i++;
                    //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php echo $rs['license_plate'] ?>
                        </td>
                        <td>
                            <?php echo $config->thaidate($rs['last_period']) ?>
                        </td>
                        <td>
                            <?php
                            echo $config->thaidate($rs['checkdate']);
                            ?>
                        </td>
                        <td>
                            <?php
                            if (substr($rs['over_day'], 0, 1) != '-') {
                                echo "<font style='color: #ff9900;'>ชำระภายใน " . $rs['over_day'] . " วัน</font>";
                            } else {
                                echo "<font style='color: red;'>เลยกำหนดชำระ " . +-$rs['over_day'] . " วัน</font>";
                            }
                            ?>
                        </td>

                        <td style=" text-align: center;">
                            <a href="<?php echo Url::to(['truck/view', 'id' => $rs['id']]) ?>"><i class="fa fa-eye text-green"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$this->registerJs("
    $(document).ready(function () {
        $('#tb_notification_over').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
    ");
?>
