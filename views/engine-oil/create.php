<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EngineOil */

$this->title = 'Create Engine Oil';
$this->params['breadcrumbs'][] = ['label' => 'Engine Oils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engine-oil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
