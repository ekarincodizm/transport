<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Config_system;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$notifications = new \app\models\Notifications();
$notify = $notifications->find()->one();

$this->title = 'พนักงานขับรถใบขับขี่หมดอายุ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well well-sm">
    <font style="color:#ff0000">* หมายเหตุ ใบขับขี่จะแจ้งเตือนก่อนหมดอายุ <?php echo $notify->driver_license; ?> วัน</font>
</div>
<!--
<div class="driver-index">
<?php // echo $this->render('_search', ['model' => $searchModel]);    ?>
    

<?php
/*
  $heading = '<i class="fa fa-users"></i> ' . $this->title;

  echo GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
  ['class' => 'yii\grid\SerialColumn'],
  'name',
  'lname',
  'card_id',
  'address',
  [
  'class' => '\kartik\grid\DataColumn',
  'label' => 'สถานะใบขับขี่',
  'hAlign' => 'center',
  'width' => '10%',
  'format' => 'raw',
  'mergeHeader' => true,
  'value' => function ($model) {
  $config = new Config_system();
  //return $model->driver_license_expire;
  $d_date = $config->Datediff_day($model->driver_license_expire);
  if ($d_date <= 0) {
  $status = "<p style='color:red;'><i class='fa fa-remove'></i> หมดอายุ</p>";
  } else if ($d_date <= 15) {
  $status = "<p style='color:orange;'><i class='fa fa-warning'></i> ใกล้หมดอายุ</p>";
  } else {
  $status = "<p style='color:green;'><i class='fa fa-check'></i> ใช้งานปกติ</p>";
  }

  return $status;
  },
  ],
  [
  'class' => 'kartik\grid\ActionColumn',
  'header' => 'ตัวเลือก',
  //'dropdown'=>true,
  //'dropdownOptions'=>['class'=>'pull-right'],
  //'urlCreator'=>function($action, $model, $key, $index) { return '#'; },
  'viewOptions' => ['title' => 'ดูข้อมูล', 'data-toggle' => 'tooltip'],
  'updateOptions' => ['title' => 'แก้ไข', 'data-toggle' => 'tooltip'],
  'deleteOptions' => ['title' => 'ลบ', 'data-toggle' => 'tooltip'],
  'headerOptions' => ['class' => 'kartik-sheet-style'],
  ],
  ],
  'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
  'headerRowOptions' => ['class' => 'kartik-sheet-style'],
  'filterRowOptions' => ['class' => 'kartik-sheet-style'],
  'responsive' => true,
  'pjax' => true, // pjax is set to always true for this demo
  'panel' => [
  'type' => GridView::TYPE_DEFAULT,
  'heading' => $heading,
  ],
  ]);
 * 
 */
?>

</div>
-->
<?php
$config = new Config_system();
?>
<div class="row">
    <?php foreach ($driver as $rs): ?>
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-primary widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-image" style=" text-align: center;">
                    <?php if (!empty($rs['images'])) { ?>
                        <img src="<?php echo Url::to('@web/web/uploads/profile/' . $rs['images']) ?>" class="img-circle" style="max-width: 100px;"/>
                    <?php } else { ?>
                        <img src="<?php echo Url::to('@web/web/images/No_image.jpg') ?>" class="img-circle" style="max-width: 125px;"/>
                    <?php } ?>
                    <br/>
                    <p style=" color: #6600ff; font-weight: bold; font-size: 16px;"><?php echo $rs['name'] . ' - ' . $rs['lname']; ?></p>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">อายุ</h5>
                                <span class="description-text">
                                    <?php
                                    $age = $config->get_age($rs['birth']);
                                    echo $age;
                                    ?>
                                </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">ใบขับขี่</h5>
                                <span class="description-text">
                                    <?php
                                    $d_date = $config->Datediff_day($rs['driver_license_expire']);
                                    if ($d_date <= 0) {
                                        $status = "<p style='color:red;'><i class='fa fa-remove'></i> หมดอายุ</p>";
                                    } else if ($d_date <= $notify->driver_license) {
                                        $status = "<p style='color:orange;'><i class='fa fa-warning'></i> เหลือหน้อย</p>";
                                    } else {
                                        $status = "<p style='color:green;'><i class='fa fa-check'></i> ใช้งานปกติ</p>";
                                    }

                                    echo $status;
                                    ?>
                                </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">ข้อมูล</h5>
                                <span class="description-text">
                                    <a href="<?php echo Url::to(['view', 'id' => $rs['id']]) ?>"><i class="fa fa-eye"></i> คลิก</a>
                                </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>      
