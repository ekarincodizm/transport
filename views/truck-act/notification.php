
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $order = new app\models\OrdersTransport();
 */

$this->title = "แจ้งเตือน พรบ. / ภาษีรถ ที่ถึงกำหนดชำระ ";
//$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$config = new app\models\Config_system();
$notifications = new \app\models\Notifications();
$notify = $notifications->find()->one();
?>
<label style=" color: #ff3300;">
    * ระบบจะแจ้งเตือนก่อน <?php echo $notify->truck_act; ?> วัน
</label>

<div class="box box-danger">
    <div class="box-header with-border">
        <?php echo $this->title; ?>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped" id="tb_notification_act">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ทะเบียนรถ</th>
                    <th>วันที่ครบกำหนดครั้งสุดท้าย</th>
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
                            <?php echo $config->thaidate($rs['act_end']) ?>
                        </td>
                        <td>
                            <?php
                            if (substr($rs['OVER_DAY'], 0, 1) == '-') {
                                echo "<font style='color:red;'>เลยมา ".+-$rs['OVER_DAY']." วัน</font>";
                            } else {
                                echo "<font style='color:orange;'>เหลือ ".$rs['OVER_DAY']." วัน</font>";
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
<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#tb_notification_act').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
                    //"scrollY" : "250px"
        });
    });


</script>
