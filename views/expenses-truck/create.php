<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExpensesTruck */

$this->title = 'Create Expenses Truck';
$this->params['breadcrumbs'][] = ['label' => 'Expenses Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-truck-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
