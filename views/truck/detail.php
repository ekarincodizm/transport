<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */
$config = new app\models\Config_system();
?>

        <?php
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

