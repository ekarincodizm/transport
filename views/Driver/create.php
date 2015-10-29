<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = 'เพิ่มพนักงานขับรถ';
$this->params['breadcrumbs'][] = ['label' => 'พนักงานขับรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-create">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-user-plus"></i> <?= Html::encode($this->title) ?></h4>
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