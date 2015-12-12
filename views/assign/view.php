<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Assign */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assign-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'assign_id',
            'order_date_start',
            'order_date_end',
            'car_id',
            'driver1',
            'driver2',
            'employer',
            'oil_set',
            'oil',
            'oil_unit',
            'oil_price',
            'gas',
            'gas_unit',
            'gas_price',
            'product_up',
            'product_down',
            'old_mile',
            'now_mile',
            'distance',
            'distance_collect',
            'avg_oil',
            'compensate',
            'transport_date',
            'cus_start',
            'cus_end',
            'changwat_start',
            'changwat_end',
            'product_type',
            'weigh',
            'type_calculus',
            'unit_price',
            'per_times',
            'income',
            'allowance_driver1',
            'allowance_driver2',
            'message',
            'create_date',
        ],
    ]) ?>

</div>
