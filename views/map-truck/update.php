<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MapTruck */

$this->title = 'รถคันที่: ' . ' ' . $model->car_id;
$this->params['breadcrumbs'][] = ['label' => 'จับคู่รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->car_id, 'url' => ['view', 'id' => $model->car_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-windows"></i> <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>
