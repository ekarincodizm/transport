<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Config_system;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'พนักงานขับรถ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
    <p>
        <?= Html::a('<i class="fa fa-user-plus"></i> เพิ่มพนักงานขับรถ', ['create'], ['class' => 'btn btn-default']) ?>
        <font style="color:#ff0000" class="pull-right">* หมายเหตุ ใบขับขี่จะแจ้งเตือนก่อนหมดอายุ 15 วัน</font>
    </p>

    <?php
    $heading = '<i class="fa fa-users"></i> ' . $this->title;

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            'lname',
            'card_id',
            'address',
            [
                'class' => '\kartik\grid\DataColumn',
                //'attribute' => 'amount',
                'label' => 'สถานะใบขับขี่',
                'hAlign' => 'center',
                'width' => '10%',
                'format' => 'raw',
                'mergeHeader' => true,
                'value' => function ($model) {
                    $config = new Config_system();
                    //return $model->driver_license_expire;
                    $d_date = $config->Datediff_day($model->driver_license_expire);
                    if ($d_date <= 0) {
                        $status = "<p style='color:red;'><i class='fa fa-remove'></i> หมดอายุ</p>";
                    } else if ($d_date <= 15) {
                        $status = "<p style='color:orange;'><i class='fa fa-warning'></i> ใกล้หมดอายุ</p>";
                    } else {
                        $status = "<p style='color:green;'><i class='fa fa-check'></i> ใช้งานปกติ</p>";
                    }

                    return $status;
                },
            ],
            // 'tel1',
            // 'tel2',
            // 'driver_license_id',
            // 'driver_license_expire',
            // 'create_date',
            // 'images',
            /*
              [
              'class' => 'yii\grid\ActionColumn',
              'mergeHeader'=>true,
              'headerOptions' => ['style' => 'text-align:center;'],
              'header' => 'action',
              'contentOptions' => ['style' => 'width:10%; text-align:center;'],
              ],
             * 
             */
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'ตัวเลือก',
                //'dropdown'=>true,
                //'dropdownOptions'=>['class'=>'pull-right'],
                //'urlCreator'=>function($action, $model, $key, $index) { return '#'; },
                'viewOptions' => ['title' => 'ดูข้อมูล', 'data-toggle' => 'tooltip'],
                'updateOptions' => ['title' => 'แก้ไข', 'data-toggle' => 'tooltip'],
                'deleteOptions' => ['title' => 'ลบ', 'data-toggle' => 'tooltip'],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'responsive' => true,
        'pjax' => true, // pjax is set to always true for this demo
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => $heading,
        ],
    ]);
    ?>

</div>
