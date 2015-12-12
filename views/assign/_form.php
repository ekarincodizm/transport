<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Assign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assign_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_date_start')->textInput() ?>

    <?= $form->field($model, 'order_date_end')->textInput() ?>

    <?= $form->field($model, 'car_id')->textInput() ?>

    <?= $form->field($model, 'driver1')->textInput() ?>

    <?= $form->field($model, 'driver2')->textInput() ?>

    <?= $form->field($model, 'employer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oil_set')->textInput() ?>

    <?= $form->field($model, 'oil')->textInput() ?>

    <?= $form->field($model, 'oil_unit')->textInput() ?>

    <?= $form->field($model, 'oil_price')->textInput() ?>

    <?= $form->field($model, 'gas')->textInput() ?>

    <?= $form->field($model, 'gas_unit')->textInput() ?>

    <?= $form->field($model, 'gas_price')->textInput() ?>

    <?= $form->field($model, 'product_up')->textInput() ?>

    <?= $form->field($model, 'product_down')->textInput() ?>

    <?= $form->field($model, 'old_mile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'now_mile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'distance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'distance_collect')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avg_oil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'compensate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transport_date')->textInput() ?>

    <?= $form->field($model, 'cus_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cus_end')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'changwat_start')->textInput() ?>

    <?= $form->field($model, 'changwat_end')->textInput() ?>

    <?= $form->field($model, 'product_type')->textInput() ?>

    <?= $form->field($model, 'weigh')->textInput() ?>

    <?= $form->field($model, 'type_calculus')->textInput() ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'per_times')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'income')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allowance_driver1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allowance_driver2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
