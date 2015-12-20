<?php

use yii\helpers\Html;
/*use yii\widgets\ActiveForm;*/
use kartik\form\ActiveForm;
/*use kartik\date\DatePicker;*/

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saving_type')->dropDownList(['1'=>'ออมทรัพย์','2'=>'กระแสรายวัน']); ?>

    <?= $form->field($model, 'bank_name')->dropDownList(['1'=>'ธนาคารออมสิน','2'=>'ธนาคารกรุงไทย','3'=>'ธนาคารกรุงศรีอยุธยา']); ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','2'=>'Inactive']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
