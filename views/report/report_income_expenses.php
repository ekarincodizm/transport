<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = "รายงาน (รายรับ - รายจ่าย)";
$this->params['breadcrumbs'][] = $this->title;

$config = new app\models\Config_system();
?>
<div class="panel panel-primary">
    <div class="panel-heading" style="padding-bottom:20px;">
        <i class="fa fa-windows"></i>
        <div class="pull-right">
            <button type="button" class="btn btn-default btn-sm">
                <i class="fa fa-print"></i> พิมพ์
            </button>
            <a href="<?php Url::to(['site/index']) ?>">
                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <?php
                // usage without model
                echo '<label>วันที่เริ่มต้น</label>';
                echo DatePicker::widget([
                    'name' => 'date_start',
                    'id' => 'date_start',
                    'value' => date('Y-m-d'),
                    'language' => 'th',
                    'removeButton' => false,
                    'readonly' => true,
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
                ?>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-5">
                <?php
                // usage without model
                echo '<label>วันที่สิ้นสุด</label>';
                echo DatePicker::widget([
                    'name' => 'date_end',
                    'id' => 'date_end',
                    'value' => date('Y-m-d'),
                    'language' => 'th',
                    'removeButton' => false,
                    'readonly' => true,
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
                ?>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2">
                <label style="color: #FFF;">.</label>
                <button type="button" class="btn btn-success btn-block"
                        onclick="get_report()"><i class="fa fa-search"></i> ดูข้อมูล</button>
            </div>
        </div>
    </div>
</div>

