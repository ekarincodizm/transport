<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->account_number;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id, 'account_number' => $model->account_number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id, 'account_number' => $model->account_number], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการจะลบรายการนี้ใช่มั้ย',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'account_number',
            'account_name',
            'saving_type',
            'bank_name',
            'status',
        ],
    ]) ?>

</div>
