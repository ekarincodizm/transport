<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DriverExpenses */

$this->title = 'Create Driver Expenses';
$this->params['breadcrumbs'][] = ['label' => 'Driver Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-expenses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
