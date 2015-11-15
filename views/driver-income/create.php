<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DriverIncome */

$this->title = 'Create Driver Income';
$this->params['breadcrumbs'][] = ['label' => 'Driver Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-income-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
