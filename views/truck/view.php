<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = "ทะเบียน " . $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-view">
    <p>
        <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-truck"></i> <?= Html::encode($this->title) ?></h4>
        </div>
        <?php
        $config = new app\models\Config_system();
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'license_plate',
                'brand',
                'model',
                'color',
                [
                    'attribute' => 'date_buy',
                    'format' => 'raw',
                    'value' => $config->thaidate($model->date_buy),
                    //'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true
                ],
                ['attribute' => 'price', 'format' => 'integer'],
                ['attribute' => 'down', 'format' => 'integer'],
                ['attribute' => 'period_price', 'format' => 'integer'],
                'period',
                'date_supply',
                [
                    'attribute' => 'type_id',
                    'format' => 'raw',
                    'value' => \app\models\Typecar::find()->where(['id' => $model->type_id])->one()['type_name'],
                    //'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true
                ],
            ],
            'mode' => 'view',
            //'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            //'hover' => true,
            'hAlign' => 'left',
            'vAlign' => 'center',
        ])
        ?>
    </div>
</div>
