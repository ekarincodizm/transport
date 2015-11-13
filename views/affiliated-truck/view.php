<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use app\models\Affiliated;
use kartik\detail\DetailView;
use app\models\Typecar;
/* @var $this yii\web\View */
/* @var $model app\models\AffiliatedTruck */
$company = Affiliated::find()->where(['company_id' => $company_id])->one()['company'];
$this->title = $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => $company, 'url' => ['affiliated/view', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-header with-border">
        <i class="fa fa-truck"></i><i class="fa fa-pencil"></i> <?= Html::encode($this->title) ?>
        <div class="pull-right">
            <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'company_id' => $company_id, '_id' => $id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', '_id' => $id, 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>


    <div class="box-body">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'company_id',
                    'format' => 'raw',
                    'value' => Affiliated::find()->where(['company_id' => $model->company_id])->one()['company'],
                    //'valueColOptions' => ['style' => 'width:30%'],
                    //'displayOnly' => true
                ],
                'license_plate',
                'brand',
                'model',
                'color',
                [
                    'attribute' => 'type_id',
                    'format' => 'raw',
                    'value' => Typecar::find()->where(['id' => $model->type_id])->one()['type_name'],
                    //'valueColOptions' => ['style' => 'width:30%'],
                    //'displayOnly' => true
                ],
            ],
        ])
        ?>
    </div>
</div>
