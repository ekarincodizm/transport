<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AffiliatedTruck */

$this->title = 'แก้ไขข้อมูลรถบรรทุก: ' . ' ' . $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['affiliated/view', 'id' => $id]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข '.$model->license_plate;
?>
<div class="box box-primary">
    <div class="box-header with-border"><i class="fa fa-truck"></i> <?= Html::encode($this->title) ?></div>
    <div class="box-body">
	    <?= $this->render('_form', [
	        'model' => $model,
	        'company_id' => $company_id,
	    ]) ?>
	</div>
</div>
