<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderTransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบสั่งงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-transport-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> สร้างใบสั่งงาน', ['create'], ['class' => 'btn btn-default']) ?>
    </p>
    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'assign_id',
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'employer',
            'label' => 'ผู้ว่าจ้าง',
            //'hAlign' => 'center',
            //'width' => '10%',
            'format' => 'raw',
            //'mergeHeader' => true,
            'value' => function ($model) {
                $customer = new \app\models\Customer();
                $cus = $customer->find()->where(['cus_id' => $model->employer])->one();
                return $cus['company'];
            },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(\app\models\Customer::find()->asArray()->all(), 'cus_id', 'company'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'ผู้ว่าจ้าง'],
                ],
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
                    'attribute' => 'car_id',
                    'label' => 'รถคันที่',
                    'mergeHeader' => true,
                    //'hAlign' => 'center',
                    //'width' => '10%',
                    //'format' => 'raw',
                    'value' => function ($model) {
                        $truck = new app\models\MapTruck();
                        $tr = $truck->find()->where(['car_id' => $model->car_id])->one();
                        return $model->car_id . " (" . $tr['truck_1'] . ') - (' . $tr['truck_2'] . ")";
                    }],
                        /*
                          ['class' => '\kartik\grid\DataColumn',
                          'attribute' => 'truck2',
                          'label' => 'ทะเบียน(พ่วง)',
                          'mergeHeader' => true,
                          'value' => function ($model) {
                          $truck = new app\models\Truck();
                          $tr = $truck->find()->where(['id' => $model->truck2])->one();
                          return $tr['license_plate'];
                          }],
                         * 
                         */
                        ['class' => '\kartik\grid\DataColumn',
                            'attribute' => 'driver1',
                            'label' => 'คนขับ1',
                            'mergeHeader' => true,
                            //'hAlign' => 'center',
                            //'width' => '10%',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $driver = new app\models\Driver();
                                $dr = $driver->find()->where(['driver_id' => $model->driver1])->one();
                                return $dr['name'] . ' ' . $dr['lname'];
                            }],
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'driver2',
                                    'label' => 'คนขับ2',
                                    'mergeHeader' => true,
                                    //'hAlign' => 'center',
                                    //'width' => '10%',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        $driver2 = new app\models\Driver();
                                        $dr2 = $driver2->find()->where(['driver_id' => $model->driver2])->one();
                                        return $dr2['name'] . ' ' . $dr2['lname'];
                                    }],
                                        ['class' => '\kartik\grid\DataColumn',
                                            'attribute' => 'imcome',
                                            'label' => 'รายได้',
                                            'mergeHeader' => true,
                                            'hAlign' => 'right',
                                            //'width' => '10%',
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                return "<font style='color:blue;'>".number_format($model->income, 2)."</font>";
                                            }],
                                        ['class' => '\kartik\grid\DataColumn',
                                            'attribute' => 'flag',
                                            'label' => 'สถานะ',
                                            'mergeHeader' => true,
                                            //'hAlign' => 'center',
                                            //'width' => '10%',
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                if ($model->flag == 1) {
                                                    $status = "<font style='color:green;'><i class='fa fa-check'></i> ชำระเงินแล้ว</font>";
                                                } else {
                                                    $status = "<font style='color:red;'><i class='fa fa-warning'></i> ค้างชำระเงิน</font>";
                                                }
                                                return $status;
                                            }],
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
                                        'pjax' => true, // pjax is set to always true for this demo
                                        'panel' => [
                                            'type' => GridView::TYPE_PRIMARY,
                                            'heading' => "<i class='fa fa-book'></i> " . $this->title,
                                        ]
                                    ]);
                                    ?>

</div>
