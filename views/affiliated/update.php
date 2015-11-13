<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Affiliated */

$this->title = 'แก้ไขข้อมูล: ' . ' ' . $model->company;
$this->params['breadcrumbs'][] = ['label' => 'บริษัทรถร่วม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="box box-primary">

    <div class="box-header with-border"><?= Html::encode($this->title) ?></div>
    <div class="box-body">
        <?=
        $this->render('_form', [
            'model' => $model,
            'company_id' => $company_id,
        ])
        ?>
    </div>
</div>
