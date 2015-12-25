<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'แก้ไขข้อมูล: ' . ' ' . $model->company;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="panel panel-primary">

    <div class="panel-heading"><i class="fa fa-building"></i><i class="fa fa-pencil"></i> <?= Html::encode($this->title) ?></div>
    <div class="panel-body">
        <?=
        $this->render('_form', [
            'model' => $model,
            'cus_id' => $cus_id,
        ])
        ?>
    </div>
</div>
