<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransportAffiliatedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-transport-affiliated-search">

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

    <?php // echo $form->field($model, 'employer') ?>

    <?php // echo $form->field($model, 'oil_set') ?>

    <?php // echo $form->field($model, 'oil') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'oil_unit') ?>

    <?php // echo $form->field($model, 'oil_price') ?>

    <?php // echo $form->field($model, 'gas') ?>

    <?php // echo $form->field($model, 'gas_unit') ?>

    <?php // echo $form->field($model, 'gas_price') ?>

    <?php // echo $form->field($model, 'product_up') ?>

    <?php // echo $form->field($model, 'product_down') ?>

    <?php // echo $form->field($model, 'old_mile') ?>

    <?php // echo $form->field($model, 'now_mile') ?>

    <?php // echo $form->field($model, 'distance') ?>

    <?php // echo $form->field($model, 'distance_collect') ?>

    <?php // echo $form->field($model, 'avg_oil') ?>

    <?php // echo $form->field($model, 'compensate') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'delete_flag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
