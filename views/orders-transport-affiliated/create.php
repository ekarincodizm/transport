<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransportAffiliated */

$this->title = 'สร้างใบปฏิบัติงาน(บริษัทรถร่วม)';
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?=
        $this->render('_form', [
            'model' => $model,
            'order_id' => $order_id,
        ]);
        ?>
    </div>
</div>
