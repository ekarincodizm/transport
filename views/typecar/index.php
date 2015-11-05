<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TypecarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภทรถ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typecar-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> เพิ่มประเภทรถ', ['create'], ['class' => 'btn btn-default']) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'type_name',
        'detail:ntext',
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
        //'filterModel' => $searchModel,
        'columns' => $columns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'responsive' => true,
        'pjax' => true, // pjax is set to always true for this demo
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => "<i class='fa fa-car'></i> " . $this->title,
        ],
    ]);
    ?>

</div>
