<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'เพิ่มข้อมูลลูกค้า';
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Html::encode($this->title) ?></div>
    <div class="panel-body">
        <?php if (!empty($error)) { ?>
        <div class="alert alert-danger" style=" text-align: center;"><i class="fa fa-warning fa-2x"></i> <h3><?php echo $error; ?></h3></div>
        <?php } ?>
        <?=
        $this->render('_form', [
            'model' => $model,
            'cus_id' => $cus_id,
        ])
        ?>
    </div>
</div>
