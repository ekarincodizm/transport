<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Salary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary')->textInput() ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_salary')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
