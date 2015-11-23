<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Annuities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="annuities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'license_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
