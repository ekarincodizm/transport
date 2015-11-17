<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */
/* @var $form yii\widgets\ActiveForm */
?>


<?php
$form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
?>

<?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'value' => $order_id, 'readonly' => 'leadonly']) ?>

<?php
echo $form->field($model, 'employer')->dropDownList(ArrayHelper::map(\app\models\Customer::find()
                        ->where(['delete_flag' => '0'])
                        ->all(), 'cus_id', 'company'), [
    'employer' => 'employer',
    'required' => 'required',
    'prompt' => 'เลือกผู้ว่าจ้าง',
        /*
          'pluginOptions' => [
          'allowClear' => true
          ],
         * 
         */
]);
?>
<?php
/*
  echo DatePicker::widget([
  'model' => $model,
  'form' => $form,
  'attribute' => 'order_date_start',
  'language' => 'th',
  'value' => date("Y-m-d"),
  'removeButton' => false,
  'readonly' => true,
  //'required' => true,
  'pluginOptions' => [
  'autoclose' => true,
  'format' => 'yyyy-mm-dd'
  ]
  ]);
 * 
 */
?>

<?php
echo $form->field($model, 'order_date_start')->widget(\kartik\widgets\DatePicker::classname(), [
    'language' => 'th',
    'removeButton' => false,
    'options' => [
        'value' => date("Y-m-d"),
        'readonly' => true,
    //'disabled' => 'disabled',
    ],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);
?>

<?php
echo $form->field($model, 'order_date_end')->widget(\kartik\widgets\DatePicker::classname(), [
    'language' => 'th',
    'removeButton' => false,
    'options' => [
        'value' => date("Y-m-d"),
        'readonly' => true,
    //'disabled' => 'disabled',
    ],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);
?>

<?php
echo $form->field($model, 'truck1')->dropDownList(ArrayHelper::map(\app\models\Truck::find()
                        ->where(['delete_flag' => '0'])
                        ->all(), 'id', 'license_plate'), [
    'id' => 'id',
    'required' => 'required',
    'prompt' => 'เลือกรถบรรทุก',
        /*
          'pluginOptions' => [
          'allowClear' => true
          ],
         * 
         */
]);
?>

<?php
echo $form->field($model, 'truck2')->dropDownList(ArrayHelper::map(\app\models\Truck::find()
                        ->where(['delete_flag' => '0'])
                        ->all(), 'id', 'license_plate'), [
    'id' => 'id',
    //'required' => 'required',
    'prompt' => 'เลือกรถถบรรทุก',
        /*
          'pluginOptions' => [
          'allowClear' => true
          ],
         * 
         */
]);
?>

<?php
$sql1 = "select id,concat(name,' ',lname) as name from driver where delete_flag = '0'";
echo $form->field($model, 'driver1')->dropDownList(ArrayHelper::map(\app\models\Driver::findBySql($sql1)->all(), 'id', 'name'), [
    'id' => 'id',
    'required' => 'required',
    'prompt' => 'เลือกคนขับ',
        /*
          'pluginOptions' => [
          'allowClear' => true
          ],
         * 
         */
]);
?>

<?php
echo $form->field($model, 'driver2')->dropDownList(ArrayHelper::map(\app\models\Driver::findBySql($sql1)->all(), 'id', 'name'), [
    'id' => 'id',
    //'required' => 'required',
    'prompt' => 'เลือกคนขับ',
        /*
          'pluginOptions' => [
          'allowClear' => true
          ],
         * 
         */
]);
?>

<div class="form-group">
    <div class="col-sm-_3 col-md-3 col-lg-3"></div>
    <div class="col-sm-9 col-md-9 col-lg-9">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึกข้อมูล' : '<i class="fa fa-pencil"></i>แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>