<?php
use yii\helpers\Html;

//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */

/* @var $model app\models\AffiliatedTruck */

/* @var $form yii\widgets\ActiveForm */
?>

<div class="affiliated-truck-form">

    <?php
$form = ActiveForm::begin([

//'id' => 'login-form-horizontal',
'type' => ActiveForm::TYPE_HORIZONTAL, 'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]]);
?>

    <?php echo $form->field($model, 'company_id')->textInput(['maxlength' => true, 'value' => $company_id, 'readonly' => 'readonly']) ?>

    <?php
echo $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(\app\models\Typecar::find()->all(), 'id', 'type_name'), ['id' => 'id', 'required' => 'required', 'prompt' => 'เลือกประเภทรถ',

/*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
*/
]);
?>

    <?php echo $form->field($model, 'license_plate')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?php
 //= $form->field($model, 'type_id')->textInput()
 ?>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo Html::submitButton($model->isNewRecord ? 'บันทึกข้อมูล' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php
ActiveForm::end(); ?>

</div>
