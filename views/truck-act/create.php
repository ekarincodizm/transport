<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TruckAct */

$this->title = 'Create Truck Act';
$this->params['breadcrumbs'][] = ['label' => 'Truck Acts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-act-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
