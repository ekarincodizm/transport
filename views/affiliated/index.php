<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\AffiliatedTruck;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AffiliatedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บริษัทรถร่วม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-header with-border">

        <div class="pull-right">
            <?= Html::a('<i class="fa fa-plus"></i> เพิ่มข้อมูลบริษัท', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'company_id',
            'company',
            'tax_number',
            'address:ntext',
            'tel',
            // 'create_date',
            ['class' => '\kartik\grid\DataColumn',
                //'attribute' => 'order_date_end',
                'label' => 'จำนวนรถ',
                'hAlign' => 'center',
                'width' => '10%',
                'format' => 'raw',
                'mergeHeader' => true,
                'value' => function ($model) {
                    return AffiliatedTruck::find()
                                    ->where(['company_id' => $model->company_id])
                                    ->count();
                }],
                    ['class' => '\kartik\grid\DataColumn',
                        //'attribute' => 'order_date_end',
                        'label' => 'จำนวนรอบ',
                        'hAlign' => 'center',
                        //'width' => '10%',
                        'format' => 'raw',
                        'mergeHeader' => true,
                        'value' => function ($model) {
                            return app\models\Affiliated::find()
                                            ->where(['company_id' => $model->company_id])
                                            ->count();
                        }],
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'header' => 'ตัวเลือก',
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
                            'heading' => "<i class='fa fa-building'></i> " . $this->title,
                        ]
                    ]);
                    ?>

</div>
