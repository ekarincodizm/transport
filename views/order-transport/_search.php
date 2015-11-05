<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderTransportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-transport-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'order_date_start') ?>

    <?= $form->field($model, 'order_date_end') ?>

    <?= $form->field($model, 'truck1') ?>

    <?php // echo $form->field($model, 'truck2') ?>

    <?php // echo $form->field($model, 'driver1') ?>

    <?php // echo $form->field($model, 'driver2') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
