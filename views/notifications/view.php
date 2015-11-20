<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = "ข้อมูลรายการแแจ้งเตือน";
//$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bell"></i> <?= Html::encode($this->title) ?>
    </div>


    <div class="panel-body">
         <p class="pull-right">
            <?= Html::a('<i class="fa fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'driver_license',
                'truck_act',
                'truck_period',
            ],
        ])
        ?>
    </div>
</div>
