<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assign-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Assign', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'assign_id',
            'order_date_start',
            'order_date_end',
            // 'car_id',
            // 'driver1',
            // 'driver2',
            // 'employer',
            // 'oil_set',
            // 'oil',
            // 'oil_unit',
            // 'oil_price',
            // 'gas',
            // 'gas_unit',
            // 'gas_price',
            // 'product_up',
            // 'product_down',
            // 'old_mile',
            // 'now_mile',
            // 'distance',
            // 'distance_collect',
            // 'avg_oil',
            // 'compensate',
            // 'transport_date',
            // 'cus_start',
            // 'cus_end',
            // 'changwat_start',
            // 'changwat_end',
            // 'product_type',
            // 'weigh',
            // 'type_calculus',
            // 'unit_price',
            // 'per_times',
            // 'income',
            // 'allowance_driver1',
            // 'allowance_driver2',
            // 'message',
            // 'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
