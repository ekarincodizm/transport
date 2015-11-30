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

    <div class="panel panel-primary">
        <div class="panel-heading" style=" padding-top: 10px;">
            <i class="fa fa-pencil"></i> <?= Html::encode($this->title) ?>
            <div class="pull-right">
            <a href="<?php echo yii\helpers\Url::to(['site/index']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
        </div>
        </div>
        <div class="panel-body" id="panel-body">
            <div class="well">
            <?=
            $this->render('_form', [
                'model' => $model,
                'driver_id' => $driver_id,
            ])
            ?>
            </div>
        </div>
    </div>

</div>
