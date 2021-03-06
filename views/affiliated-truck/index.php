<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AffiliatedTruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Affiliated Trucks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affiliated-truck-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Affiliated Truck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'company_id',
            'license_plate',
            'brand',
            'model',
            // 'color',
            'type_id',
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'ประเภท',
                'hAlign' => 'center',
                'width' => '10%',
                'format' => 'raw',
                'mergeHeader' => true,
                'value' => function ($model) {
                   return $model->type_id;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
