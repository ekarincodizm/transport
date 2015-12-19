<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderTransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบปฏิบัติงาน(จ้างบริษัทร่วม)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-transport-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> สร้างใบปฏิบัติงาน', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'order_id',
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'order_date_start',
            'label' => 'วันที่ไป',
            'hAlign' => 'center',
            'width' => '10%',
            'format' => 'raw',
            'mergeHeader' => true,
            'value' => function ($model) {
                $config = new \app\models\Config_system();
                return $config->thaidate($model->order_date_start);
            }],
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'order_date_end',
            'label' => 'วันที่กลับ',
            'hAlign' => 'center',
            'width' => '10%',
            'format' => 'raw',
            'mergeHeader' => true,
            'value' => function ($model) {
                $config = new \app\models\Config_system();
                return $config->thaidate($model->order_date_end);
            }],
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'truck1',
            'label' => 'ทะเบียนรถ',
            'mergeHeader' => true,
            //'hAlign' => 'center',
            //'width' => '10%',
            //'format' => 'raw',
            'value' => function ($model) {
                $truck = new app\models\AffiliatedTruck();
                $tr = $truck->find()->where(['id' => $model->truck1])->one();
                return $tr['license_plate'];
            }],
                ['class' => '\kartik\grid\DataColumn',
                    'attribute' => 'truck2',
                    'label' => 'ทะเบียน(พ่วง)',
                    'mergeHeader' => true,
                    //'hAlign' => 'center',
                    //'width' => '10%',
                    //'format' => 'raw',
                    'value' => function ($model) {
                        $truck = new app\models\AffiliatedTruck();
                        $tr = $truck->find()->where(['id' => $model->truck2])->one();
                        return $tr['license_plate'];
                    }],
                        ['class' => '\kartik\grid\DataColumn',
                            'attribute' => 'driver1',
                            'label' => 'คนขับ1',
                            'mergeHeader' => true,],
                        ['class' => '\kartik\grid\DataColumn',
                            'attribute' => 'driver2',
                            'label' => 'คนขับ2',
                            'mergeHeader' => true,],
                        ['class' => '\kartik\grid\DataColumn',
                            'attribute' => 'flag',
                            'label' => 'สถานะ',
                            'format' => 'raw',
                            'mergeHeader' => true,
                            'value' => function ($model) {
                                if ($model->flag == 1) {
                                    $status = "<font style='color:green;'>จ่ายเงินแล้ว</font>";
                                } else {
                                    $status = "<font style='color:red;'>ค้างจ่าย</font>";
                                }
                                return $status;
                            }
                        ],
                        // 'truck2',
                        // 'driver1',
                        // 'driver2',
                        // 'create_date',
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'header' => 'ตัวเลือก',
                            'viewOptions' => ['title' => 'ดูข้อมูล', 'data-toggle' => 'tooltip'],
                            'updateOptions' => ['title' => 'แก้ไข', 'data-toggle' => 'tooltip'],
                            'deleteOptions' => ['title' => 'ลบ', 'data-toggle' => 'tooltip'],
                            'headerOptions' => ['class' => 'kartik-sheet-style'],
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
                        'persistResize' => false,
                        'pjax' => true, // pjax is set to always true for this demo
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => "<i class='fa fa-book'></i> " . $this->title,
                        ]
                    ]);
                    ?>

</div>
