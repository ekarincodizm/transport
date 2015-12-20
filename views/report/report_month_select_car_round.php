<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MapTruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บัญชีค่าใช้จ่ายของรถประจำเดือน(ต่อเที่ยววิ่ง)';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="map-truck-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        [
            'attribute' => 'car_id',
            'label' => 'รถคันที่',
            'mergeHeader' => true,
            'value' => function ($model) {
                return $model->car_id;
            },
            ],
        [
            'attribute' => 'truck_1',
            'label' => 'ทะเบียนรถ',
            'mergeHeader' => true,
            'value' => function ($model) {
                return "(" . $model->truck_1 . ') - (' . $model->truck_2 . ")";
            },
        ],
        [
            'attribute' => 'driver',
            'label' => 'คนขับประจำ',
            'mergeHeader' => true,
            //'width' => '200px',
            'value' => function ($model) {
                $truck = \app\models\MapDriver::find()->where(['car_id' => $model->car_id])->one();
                $driver = \app\models\Driver::find()->where(['driver_id' => $truck['driver']])->one();
                return $driver['name'] . ' - ' . $driver['lname'];
            },
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'header' => 'ตัวเลือก',
                    'label' => 'วันที่ไป',
                    'hAlign' => 'center',
                    //'width' => '10%',
                    'format' => 'raw',
                    'mergeHeader' => true,
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'value' => function($model){
                     return Html::a("ดูค่าใช้จ่ายคันนี้", Url::to(['report/mas_report_month_select_car_round','car_id' => $model->car_id]), "");
                    }
                ],
            ];
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'responsive' => true,
                'pjax' => true, // pjax is set to always true for this demo
                'panel' => [
                    'type' => GridView::TYPE_DEFAULT,
                    'heading' => "<i class='fa fa-truck'></i> " . $this->title,
                ],
            ]);
            ?>

</div>
