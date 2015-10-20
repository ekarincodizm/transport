<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = 'เพิ่มรถบรรทุก';
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-create">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-truck"></i> <?= Html::encode($this->title) ?></h4>
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
