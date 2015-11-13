<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Affiliated */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="affiliated-form">
    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>
    
    <?= $form->field($model, 'company_id')->textInput(['maxlength' => true, 'value' => $company_id, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-sm-_2 col-md-2 col-lg-2"></div>
        <div class="col-sm-10 col-md-10 col-lg-10">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึกข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
