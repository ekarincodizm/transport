<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = 'สร้างใบปฏิบัติงาน';
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-transport-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'order_id' => $order_id,
    ])
    ?>

</div>
