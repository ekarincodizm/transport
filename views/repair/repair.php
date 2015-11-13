
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $config = new app\models\Config_system();
  $order = new app\models\OrdersTransport();
 */
use yii\helpers\Html;
$config = new app\models\Config_system();
/* @var $this yii\web\View */
/* @var $model app\models\Repair */

$this->title = 'ทะเบียนรถ: ' . ' ' . $truck_license;
$this->params['breadcrumbs'][] = 'บันทึกรายการซ่อม: ' . $truck_license;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-cogs"></i> <?php echo $this->title; ?>
        <div class="pull-right">
            <a href="<?php echo Url::to(['repair/create', 'truck_license' => $truck_license]) ?>">
                <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มรายการซ่อม</button>
            </a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped" id="result_repair">
            <thead>
                <tr>
                    <th>#</th>
                    <th>วันที่</th>
                    <th>รายการ</th>
                    <th style="text-align: center;">จำนวนเงิน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($repair as $rs): $i++;
                    //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php echo $config->thaidate($rs['create_date']) ?>
                        </td>
                        <td><?php echo $rs['detail'] ?></td>
                        <td style=" text-align: right;">
                            <?php echo number_format($rs['price'], 2); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$this->registerJs('
    $(function () {
        $("#result_repair").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollY": "250px"
        });
    });
    ');
?>
