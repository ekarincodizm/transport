<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รถบรรทุก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> เพิ่มรถบรรทุก', ['create'], ['class' => 'btn btn-default']) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'license_plate',
        'brand',
        'model',
        'color',
        // 'date_buy',
        // 'price',
        // 'down',
        // 'period_price',
        // 'period',
        // 'date_supply',
        //'type_id',
        [
            'attribute' => 'type_id',
            'width' => '200px',
            'value' => function ($model) {
                return \app\models\Typecar::find()->where(['id' => $model->type_id])->one()['type_name'];
            },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(\app\models\Typecar::find()->orderBy('type_name')->asArray()->all(), 'id', 'type_name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'ประเภทรถ'],
                //'group'=>true,  // enable grouping
                ],
                [
                    'attribute' => 'status',
                    'hAlign' => 'center',
                    'format' => 'raw',
                    'value' => function ($model) {
                if($model->status == '1'){
                    $status = "<font style='color:red'>ถูกจำหน่าย</font>";
                } else {
                    $status = "<font style='color:green'>ใช้งานได้</font>";
                }
                        return $status;
                    },
                        ],
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
