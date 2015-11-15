<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DriverIncome */

$this->title = 'Update Driver Income: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Driver Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-income-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
