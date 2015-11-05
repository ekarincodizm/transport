<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutgoingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าใช้จ่ายอื่น ๆ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outgoings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Outgoings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'order_id',
            'detail',
            'price',
            'create_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
