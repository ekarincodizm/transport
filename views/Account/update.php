<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = 'แก้ไขบัญชี: ' . ' ' . $model->account_number;
$this->params['breadcrumbs'][] = ['label' => 'บัญชี', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="panel panel-primary">

    <div class="panel-heading"><i class="fa fa-edit"></i> <?= Html::encode($this->title) ?></div>
    <div class="panel-body">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>
