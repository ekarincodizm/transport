<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
?>
<div class="orders-transport-view">
    <!--
        #ข้อมูลใบปฏิบัติงาน
        Comment By Kimniyom
    -->
    <div class="jumbotron" style="padding: 5px;">
        <p>
            <?= Html::a('<i class="fa fa-pencil"></i> แก้ไขใบปฏิบัติงาน', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
        </p>
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3"><label>ใบบฏิบัติงาน</label> <label class="label label-success"><?php echo $model->order_id; ?></label></div>
            <div class="col-sm-6 col-md-3 col-lg-3"><label>วันที่ไป</label> <label class="label label-success"><?php echo $model->order_date_start; ?></label></div>
            <div class="col-sm-6 col-md-3 col-lg-3"><label>วันที่กลับ</label> <label class="label label-success"><?php echo $model->order_date_end; ?></label></div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <?php
                echo "<label>ทะเบียนรถ </label>";
                $rs = $truck_model->find()->where(['id' => $model->truck1])->one();
                echo '<label class="label label-success">' . $rs['license_plate'] . '</label>';
                ?>

                <?php
                echo " <label>ทะเบียนพ่วง </label>";
                $rs2 = $truck_model->find()->where(['id' => $model->truck2])->one();
                if (!empty($rs2)) {
                    echo '<label class="label label-success">' . $rs2['license_plate'] . '</label>';
                } else {
                    echo " -";
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-2 col-lg-3">
                <label>คนขับ 1</label> 
                <label class="label label-success">
                    <?php
                    $d1 = $driver->find()->where(['id' => $model->driver1])->one();
                    echo $d1['name'] . ' ' . $d1['lname'];
                    ?></label>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-3">
                <label>คนขับ 2</label> 
                <label class="label label-success">
                    <?php
                    $d2 = $driver->find()->where(['id' => $model->driver2])->one();
                    if (!empty($d2)) {
                        echo $d2['name'] . ' ' . $d2['lname'];
                    } else {
                        echo "-";
                    }
                    ?></label>
            </div>
        </div>
    </div>
    <!--
        ###################### END #########################
    -->

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'order_date_start',
            'order_date_end',
            'truck1',
            'truck2',
            'driver1',
            'driver2',
            'create_date',
        ],
    ])
    ?>

</div>
