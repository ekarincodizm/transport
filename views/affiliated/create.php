<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Affiliated */

$this->title = 'เพิ่มข้อมูลบริษัทรถร่วม';
$this->params['breadcrumbs'][] = ['label' => 'บริษัทรถร่วม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affiliated-create">
    <div class="box box-primary">
        <div class="box-header with-border"><i class="fa fa-plus"></i> <?= Html::encode($this->title) ?></div>
        <div class="box-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'company_id' => $company_id,
            ])
            ?>
        </div>
    </div>
</div>
