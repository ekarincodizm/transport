<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use app\models\Affiliated;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use app\models\Customer;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransportAffiliated */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-transport-affiliated-form">

    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <div class="box box-info">
        <div class="box-header with-border">ผู้ว่าจ้าง</div>
        <div class="box-body">
            <?= $form->field($model, 'order_id')->textInput(['value' => $order_id, 'readonly' => 'readonly']) ?>
            <?=
            $form->field($model, 'employer')->dropdownList(
                    ArrayHelper::map(Customer::find()->all(), 'cus_id', 'company'), [
                'id' => 'cus_id',
                'required' => 'required',
                'prompt' => 'เลือกบริษัทผู้ว่าจ้าง'
            ]);
            ?>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header with-border">บริษัทรถร่วม</div>
        <div class="box-body">
            <?=
            $form->field($model, 'company_id')->dropdownList(
                    ArrayHelper::map(Affiliated::find()->all(), 'company_id', 'company'), [
                'id' => 'company_id',
                'required' => 'required',
                'prompt' => 'เลือกบริษัทรถร่วม'
            ]);
            ?>

            <?=
            $form->field($model, 'truck1')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(\app\models\AffiliatedTruck::find()->where(['company_id' => $model->company_id])->all(), 'id', 'license_plate'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'truck1'],
                //'data' => [$model->truck1],
                'pluginOptions' => [
                    'required' => 'required',
                    'depends' => ['company_id'],
                    'placeholder' => 'เลือกรถ...',
                    'url' => Url::to(['orders-transport-affiliated/get_truck'])
                ]
            ]);
            ?>

            <?=
            $form->field($model, 'truck2')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(\app\models\AffiliatedTruck::find()->where(['company_id' => $model->company_id])->all(), 'id', 'license_plate'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'truck2'],
                'pluginOptions' => [
                    'depends' => ['company_id'],
                    'placeholder' => 'เลือกรถ...',
                    'url' => Url::to(['orders-transport-affiliated/get_truck2'])
                ]
            ]);
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
            echo $form->field($model, 'driver1')->textInput(['maxlength' => true]);
            ?>

            <?php
            echo $form->field($model, 'driver2')->textInput(['maxlength' => true]);
            ?>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-_3 col-md-3 col-lg-3"></div>
        <div class="col-sm-9 col-md-9 col-lg-9">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึกข้อมูล' : '<i class="fa fa-pencil"></i>แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
