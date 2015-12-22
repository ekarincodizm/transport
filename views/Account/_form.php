<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\savingType;
/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>
    <?php
        echo $form->field($model, 'saving_type')
                ->dropDownList(ArrayHelper::map(\app\models\savingType::find()
                        ->all(),'saving_type','saving_type'),
            ['saving_type' =>
                'saving_type', 'required' => 'required', 'prompt' => 'เลือกประเภทบัญชี',]);
    ?>
    <?php
        echo $form->field($model, 'bank_name')
                ->dropDownList(ArrayHelper::map(\app\models\BankName::find()
                        ->all(),'bank_name','bank_name'),
            ['bank_name' =>
                'bank_name', 'required' => 'required', 'prompt' => 'เลือกธนาคาร',]);
    ?>
    <?= $form->field($model, 'brance')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
