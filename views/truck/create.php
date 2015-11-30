<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = 'เพิ่มรถบรรทุก';
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-create">

    <div class="panel panel-primary">
        <div class="panel-heading">
           <i class="fa fa-truck"></i> <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">

            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>

</div>
