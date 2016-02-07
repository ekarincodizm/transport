<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บัญชีธนาคาร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?= Html::a('เพิ่มบัญชีธนาคาร', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'responsive' => true,
        'pjax' => false, // pjax is set to always true for this demo
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "<i class='fa fa-book'></i> " . $this->title,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => '\kartik\grid\DataColumn',
                //'attribute' => 'status',
                'label' => 'เลือก',
                'mergeHeader' => true,
                'hAlign' => 'center',
                //'width' => '10%',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        $btn = "<button type='button' class='btn btn-default btn-sm' disabled='disabled'><i class='fa fa-check'></check></button>";
                    } else {
                        $btn = "<button type='button' class='btn btn-danger btn-sm' onclick='set_active($model->id)'><i class='fa fa-download'></check></button>";
                    }
                    return $btn;
                }],
            'account_number',
            'account_name',
            'saving_type',
            'bank_name',
            'brance',
            ['class' => '\kartik\grid\DataColumn',
                'attribute' => 'status',
                'label' => 'สถานะ',
                'mergeHeader' => true,
                //'hAlign' => 'center',
                //'width' => '10%',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        $status = "<font style='color:green;'><i class='fa fa-check'></i> ใช้งาน</font>";
                    } else {
                        $status = "<font style='color:red;'><i class='fa fa-warning'></i> ไม่ใช้งาน</font>";
                    }
                    return $status;
                }],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'ตัวเลือก',
            ],
        ],
    ]);
    ?>

</div>

<script type="text/javascript">
    function set_active(id){
        var url = "<?php echo Url::to(['account/set_active'])?>";
        var data = {id: id};
        $.post(url,data,function(success){
            window.location.reload();
        });
    }
</script>

