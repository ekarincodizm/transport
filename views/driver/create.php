<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = 'เพิ่มพนักงานขับรถ';
$this->params['breadcrumbs'][] = ['label' => 'พนักงานขับรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-create">
    <div class="panel panel-primary">
        <div class="panel-heading" style=" padding-bottom: 20px;">
            <i class="fa fa-user-plus"></i> <?= Html::encode($this->title) ?>
            <div class="pull-right">
                <a href="<?php echo yii\helpers\Url::to(['site/index'])?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
            </div>
        </div>
        <div class="panel-body">
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