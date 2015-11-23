<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Annuities */

$this->title = 'Create Annuities';
$this->params['breadcrumbs'][] = ['label' => 'Annuities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="annuities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
