<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> เพิ่มข้อมูลลูกค้า', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'cus_id',
        'company',
        'tax_number',
        'address',
        'tel',
        'agent',
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
            'heading' => "<i class='fa fa-building'></i> " . $this->title,
        ]
    ]);
    ?>

</div>
