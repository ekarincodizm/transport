<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->companyname;
//$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">

        <?= Html::encode($this->title) ?>
    </div>

    <div class="panel-body">
        <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>
        <br/> <br/>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'companyname',
                'address',
                'contact',
                'taxation_number',
                'account_number',
                'ceo',
            ],
        ])
        ?>

        <p>
            <?= Html::a('<i class="fa fa-edit"></i>แก้ไขข้อมูล', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</div>
