<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductType */

$this->title = $model->product_type;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?=
    Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ])
    ?>
</p>
<div class="panel panel-default">

    <div class="panel-heading"><?= Html::encode($this->title) ?></div>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_type',
        ],
    ])
    ?>

</div>
