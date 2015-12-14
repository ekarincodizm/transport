<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'companyname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxation_number')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ceo')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="well text-center">
                <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>
            </div>
        </div>
        <div class="col-sm-7 col-md-7 col-md-7">

        </div>
    </div>

    <?= $form->field($model, 'logo')->fileInput() ?>
    <hr/>
    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-sm-10 col-md-10 col-lg-10" style=" padding-left: 30px;">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึกข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
