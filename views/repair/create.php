<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Repair */

$this->title = 'เพิ่มรายการซ่อม';
$this->params['breadcrumbs'][] = ['label' => 'รายการซ่อม', 'url' => ['view','truck_license' => $truck_license]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-header with-border">
        <i class="fa fa-cog"></i> <?= Html::encode($this->title) ?>
    </div>
    <div class="box-body">
        <?=
        $this->render('_form', [
            'model' => $model,
            'truck_license' => $truck_license,
        ])
        ?>
    </div>
</div>
