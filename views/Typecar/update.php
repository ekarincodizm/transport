<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Typecar */

$this->title = 'แก้ไขประเภท: ' . ' ' . $model->type_name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="typecar-update">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-car"></i> <?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
