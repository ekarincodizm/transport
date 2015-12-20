<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เพิ่มบัญชีธนาคาร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มบัญชีธนาคารใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'account_number',
            'account_name',
            ['label'=>'ประเภทบัญชี',
                'attribute'=>'saving_type',
                'filter'=>array("1"=>"ออมทรัพย์","2"=>"กระแสรายวัน"),
                'value'=>function($data){
                $arr=array("1"=>"ออมทรัพย์","2"=>"กระแสรายวัน");
                return $arr[$data->saving_type];
                }
            ],
            ['label'=>'ธนาคาร',
                'attribute'=>'bank_name',
                'filter'=>array("1"=>"ธนาคารออมสิน","2"=>"ธนาคารกรุงไทย","3"=>"ธนาคารกรุงศรีอยุธยา"),
                'value'=>function($data){
                $arr=array("1"=>"ธนาคารออมสิน","2"=>"ธนาคารกรุงไทย","3"=>"ธนาคารกรุงศรีอยุธยา");
                return $arr[$data->bank_name];
                }
            ],
            ['label'=>'สถานะการใช้งาน',
                'attribute'=>'status',
                'filter'=>array("1"=>"Active","2"=>"Inactive"),
                'value'=>function($data){
                $arr=array("1"=>"Active","2"=>"Inactive");
                return $arr[$data->status];
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
