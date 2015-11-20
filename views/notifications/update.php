<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = 'แก้ไขข้อมูลการแจ้งเตือน';
/*
  $this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
 * 
 */
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลการแจ้งเตือน', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-warning">

    <div class="panel-heading"><i class="fa fa-upload"></i> <?= Html::encode($this->title) ?></div>
    <div class="panel-body">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>
