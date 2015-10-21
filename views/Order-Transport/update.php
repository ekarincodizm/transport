<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = 'Update Orders Transport: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders Transports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-transport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'order_id' => $order_id,
    ]) ?>

</div>
