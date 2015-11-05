<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TruckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="truck-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'license_plate') ?>

    <?= $form->field($model, 'brand') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'date_buy') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'down') ?>

    <?php // echo $form->field($model, 'period_price') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'date_supply') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
