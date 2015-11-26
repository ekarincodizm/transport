<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = 'แก้ไข : ' . ' ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="box box-default">
    <div class="box-header with-border"><i class="fa fa-pencil"></i> <?php echo $this->title; ?></div>
    <div class="box-body">

        <?=
        $this->render('_form', [
            'model' => $model,
            'order_id' => $order_id,
        ]);
        ?>
    </div>
</div>
