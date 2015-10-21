<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = 'Create Orders Transport';
$this->params['breadcrumbs'][] = ['label' => 'Orders Transports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-transport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'order_id' => $order_id,
    ]) ?>

</div>
