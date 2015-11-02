<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExpensesTruck */

$this->title = 'Update Expenses Truck: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expenses Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenses-truck-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
