<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลบริษัท';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-university text-success"></i> ข้อมูลบริษัท', ['create'], ['class' => 'btn btn-default']) ?>
    </p>
    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'companyname',
        'address',
        'contact',
        'taxation_number',
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
            'type' => GridView::TYPE_DEFAULT,
            'heading' => "<i class='fa fa-building'></i> " . $this->title,
        ]
    ]);
    ?>
</div>
