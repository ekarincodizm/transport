<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TruckAct */

$this->title = 'Update Truck Act: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Truck Acts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="truck-act-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
