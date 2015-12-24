<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = 'แก้ไข: ' . ' ' . $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->license_plate, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$sql = "SELECT * FROM map_truck WHERE (truck_1 = '$model->license_plate' OR truck_2 = '$model->license_plate') ";
$resut = Yii::$app->db->createCommand($sql)->queryOne();
if (!empty($resut)) {
    $flag = "1";
} else {
    $flag = "";
}
?>
<div class="truck-update">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-truck"></i> <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body" id="panel-body">

            <?=
            $this->render('_form', [
                'model' => $model,
                'flag' => $flag,
            ])
            ?>
        </div>
    </div>
</div>
