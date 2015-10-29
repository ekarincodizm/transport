<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = 'แก้ไขพนักงานขับรถ: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'พนักงานขับรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-update">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-pencil"></i> <?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'driver_id' => $driver_id,
            ])
            ?>
        </div>
    </div>

</div>
