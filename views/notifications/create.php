<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = 'Create Notifications';
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-warning">

    <div class="panel-heading"><?= Html::encode($this->title) ?></div>
    <div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
