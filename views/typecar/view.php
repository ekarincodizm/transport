<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Typecar */

$this->title = $model->type_name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typecar-view">

    <p>
        <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-car"></i> <?= Html::encode($this->title) ?></h4>
        </div>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'type_name',
                    'detail:ntext',
                ],
            ])
            ?>

    </div>
</div>
