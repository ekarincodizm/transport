<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SalaryMaster */

$this->title = 'Create Salary Master';
$this->params['breadcrumbs'][] = ['label' => 'Salary Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salary-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
