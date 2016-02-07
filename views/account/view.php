<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->account_number;
$this->params['breadcrumbs'][] = ['label' => 'บัญชี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

function get_status($type = null) {
    if ($type == 1) {
        $status = "<i class='fa fa-check text-green'></i>ใช้งาน";
    } else {
        $status = "<i class='fa fa-ban text-red'></i>ไม่ใช้งาน";
    }
    return $status;
}
?>
<div class="panel panel-primary">

    <div class="panel-heading">
        <i class="fa fa-book"></i>
        <?= Html::encode($this->title) ?>
    </div>


    <div class="panel-body">
        <p class="pull-right">
            <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('ลบรายการ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'คุณต้องการลบรายนี้ใช่มั้ย?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'account_number',
                'account_name',
                'saving_type',
                'bank_name',
                'brance',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => get_status($model->status),
                    //'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true
                ],
            ],
        ])
        ?>
    </div>
</div>
