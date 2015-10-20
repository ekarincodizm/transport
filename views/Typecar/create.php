<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Typecar */

$this->title = 'เพิ่มประเภทรถ';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typecar-create">
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
