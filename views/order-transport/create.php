<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = 'สร้างใบปฏิบัติงาน';
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header with-border"><i class="fa fa-plus"></i> <?php echo $this->title; ?></div>
    <div class="box-body">
        <?=
        $this->render('_form', [
            'model' => $model,
            'order_id' => $order_id,
        ])
        ?>
    </div>
</div>
