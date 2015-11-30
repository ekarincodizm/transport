<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = 'แก้ไข: ' . ' ' . $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->license_plate, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-update">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-truck"></i> <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body" id="panel-body">

            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
