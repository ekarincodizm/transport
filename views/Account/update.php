<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = 'แก้ไขบัญชี: ' . ' ' . $model->account_number;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'account_number' => $model->account_number]];
$this->params['breadcrumbs'][] = 'แก้ไขบัญชี';
?>
<div class="account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
