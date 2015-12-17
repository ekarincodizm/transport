<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderTransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$model_customer = new app\models\Customer();
$result_cus = $model_customer->find()->where(['cus_id' => $cus_id])->one();

$this->title = 'ออกบิลแจ้งหนี้บริษัท ' . $result_cus['company'];
$this->params['breadcrumbs'][] = $this->title;
?>

<button type="button" id="print_bill" class="btn btn-default"><i class="fa fa-print"></i> พิมพ์บิลที่เลือก</button>
<br/><br/>
<div class="orders-transport-index">

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        [
            'class' => 'kartik\grid\CheckboxColumn',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
        //'pageSummary' => true,
        //'rowSelectedClass' => GridView::TYPE_INFO,
        ],
        //'id',
        'assign_id',
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'order_date_start',
            'label' => 'วันที่ไป',
            'hAlign' => 'center',
            'width' => '10%',
            'format' => 'raw',
            'mergeHeader' => true,
            'value' => function ($model) {
                $config = new \app\models\Config_system();
                return $config->thaidate($model->order_date_start);
            }],
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'order_date_end',
            'label' => 'วันที่กลับ',
            'hAlign' => 'center',
            'width' => '10%',
            'format' => 'raw',
            'mergeHeader' => true,
            'value' => function ($model) {
                $config = new \app\models\Config_system();
                return $config->thaidate($model->order_date_end);
            }],
        ['class' => '\kartik\grid\DataColumn',
            'attribute' => 'car_id',
            'label' => 'รถคันที่',
            'mergeHeader' => true,
            //'hAlign' => 'center',
            //'width' => '10%',
            //'format' => 'raw',
            'value' => function ($model) {
                $truck = new app\models\MapTruck();
                $tr = $truck->find()->where(['car_id' => $model->car_id])->one();
                return $model->car_id . " (" . $tr['truck_1'] . ') - (' . $tr['truck_2'] . ")";
            }],
                /*
                  ['class' => '\kartik\grid\DataColumn',
                  'attribute' => 'truck2',
                  'label' => 'ทะเบียน(พ่วง)',
                  'mergeHeader' => true,
                  'value' => function ($model) {
                  $truck = new app\models\Truck();
                  $tr = $truck->find()->where(['id' => $model->truck2])->one();
                  return $tr['license_plate'];
                  }],
                 * 
                 */
                ['class' => '\kartik\grid\DataColumn',
                    'attribute' => 'driver1',
                    'label' => 'คนขับ1',
                    'mergeHeader' => true,
                    //'hAlign' => 'center',
                    //'width' => '10%',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $driver = new app\models\Driver();
                        $dr = $driver->find()->where(['driver_id' => $model->driver1])->one();
                        return $dr['name'] . ' ' . $dr['lname'];
                    }],
                        ['class' => '\kartik\grid\DataColumn',
                            'attribute' => 'driver2',
                            'label' => 'คนขับ2',
                            'mergeHeader' => true,
                            //'hAlign' => 'center',
                            //'width' => '10%',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $driver2 = new app\models\Driver();
                                $dr2 = $driver2->find()->where(['driver_id' => $model->driver2])->one();
                                return $dr2['name'] . ' ' . $dr2['lname'];
                            }],
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'imcome',
                                    'label' => 'รายได้',
                                    'mergeHeader' => true,
                                    'hAlign' => 'right',
                                    //'width' => '10%',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return "<font style='color:blue;'>" . number_format($model->income, 2) . "</font>";
                                    }],
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'flag',
                                    'label' => 'สถานะ',
                                    'mergeHeader' => true,
                                    //'hAlign' => 'center',
                                    //'width' => '10%',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if ($model->flag == 1) {
                                            $status = "<font style='color:green;'><i class='fa fa-check'></i> ชำระเงินแล้ว</font>";
                                        } else {
                                            $status = "<font style='color:red;'><i class='fa fa-warning'></i> ค้างชำระเงิน</font>";
                                        }
                                        return $status;
                                    }],
                                    // 'truck2',
                                    // 'driver1',
                                    // 'driver2',
                                    // 'create_date',

                                    /*
                                      [
                                      'class' => 'kartik\grid\ActionColumn',
                                      'header' => 'ตัวเลือก',
                                      'viewOptions' => ['title' => 'ดูข้อมูล', 'data-toggle' => 'tooltip'],
                                      'updateOptions' => ['title' => 'แก้ไข', 'data-toggle' => 'tooltip'],
                                      'deleteOptions' => ['title' => 'ลบ', 'data-toggle' => 'tooltip'],
                                      'headerOptions' => ['class' => 'kartik-sheet-style'],
                                      ],
                                     * 
                                     */
                            ];
                            echo GridView::widget([
                                'dataProvider' => $dataProvider,
                                //'filterModel' => $searchModel,
                                'columns' => $columns,
                                'options' => ['id' => 'assign'],
                                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                                //'containerOptions' => ['class' => 'hotel-pjax-container'],
                                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                                'responsive' => true,
                                'pjax' => true, // pjax is set to always true for this demo
                                'panel' => [
                                    'type' => GridView::TYPE_PRIMARY,
                                    'heading' => "<i class='fa fa-book'></i> " . $this->title."(รถภายใน)",
                                ]
                            ]);
                            ?>

                            <!-- DT 2 -->
                            <?php
                            $columns2 = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                [
                                    'class' => 'kartik\grid\CheckboxColumn',
                                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                                   
                                //'pageSummary' => true,
                                //'rowSelectedClass' => GridView::TYPE_INFO,
                                ],
                                //'id',
                                'order_id',
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'order_date_start',
                                    'label' => 'วันที่ไป',
                                    'hAlign' => 'center',
                                    'width' => '10%',
                                    'format' => 'raw',
                                    'mergeHeader' => true,
                                    'value' => function ($model) {
                                        $config = new \app\models\Config_system();
                                        return $config->thaidate($model['order_date_start']);
                                    }],
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'order_date_end',
                                    'label' => 'วันที่กลับ',
                                    'hAlign' => 'center',
                                    'width' => '10%',
                                    'format' => 'raw',
                                    'mergeHeader' => true,
                                    'value' => function ($model) {
                                        $config = new \app\models\Config_system();
                                        return $config->thaidate($model['order_date_end']);
                                    }],
                                /*
                                  ['class' => '\kartik\grid\DataColumn',
                                  'attribute' => 'car_id',
                                  'label' => 'รถคันที่',
                                  'mergeHeader' => true,
                                  //'hAlign' => 'center',
                                  //'width' => '10%',
                                  //'format' => 'raw',
                                  'value' => function ($model) {
                                  $truck = new app\models\MapTruck();
                                  $tr = $truck->find()->where(['car_id' => $model->car_id])->one();
                                  return $model->car_id . " (" . $tr['truck_1'] . ') - (' . $tr['truck_2'] . ")";
                                  }],
                                 * 
                                 */
                                /*
                                  ['class' => '\kartik\grid\DataColumn',
                                  'attribute' => 'truck2',
                                  'label' => 'ทะเบียน(พ่วง)',
                                  'mergeHeader' => true,
                                  'value' => function ($model) {
                                  $truck = new app\models\Truck();
                                  $tr = $truck->find()->where(['id' => $model->truck2])->one();
                                  return $tr['license_plate'];
                                  }],
                                 * 
                                 */
                                'driver1',
                                'driver2',
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'imcome',
                                    'label' => 'รายได้',
                                    'mergeHeader' => true,
                                    'hAlign' => 'right',
                                    //'width' => '10%',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return "<font style='color:blue;'>".number_format($model['price_employer'], 2) . "</font>";
                                    }],
                                ['class' => '\kartik\grid\DataColumn',
                                    'attribute' => 'flag',
                                    'label' => 'สถานะ',
                                    'mergeHeader' => true,
                                    //'hAlign' => 'center',
                                    //'width' => '10%',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if ($model['flag'] == 1) {
                                            $status = "<font style='color:green;'><i class='fa fa-check'></i> ชำระเงินแล้ว</font>";
                                        } else {
                                            $status = "<font style='color:red;'><i class='fa fa-warning'></i> ค้างชำระเงิน</font>";
                                        }
                                        return $status;
                                    }],
                                    // 'truck2',
                                    // 'driver1',
                                    // 'driver2',
                                    // 'create_date',

                                    /*
                                      [
                                      'class' => 'kartik\grid\ActionColumn',
                                      'header' => 'ตัวเลือก',
                                      'viewOptions' => ['title' => 'ดูข้อมูล', 'data-toggle' => 'tooltip'],
                                      'updateOptions' => ['title' => 'แก้ไข', 'data-toggle' => 'tooltip'],
                                      'deleteOptions' => ['title' => 'ลบ', 'data-toggle' => 'tooltip'],
                                      'headerOptions' => ['class' => 'kartik-sheet-style'],
                                      ],
                                     * 
                                     */
                            ];
                            echo GridView::widget([
                                'dataProvider' => $dataProvider2,
                                //'filterModel' => $searchModel,
                                'columns' => $columns2,
                                'options' => ['id' => 'assign_out'],
                                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                                //'containerOptions' => ['class' => 'hotel-pjax-container'],
                                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                                'responsive' => true,
                                'pjax' => true, // pjax is set to always true for this demo
                                'panel' => [
                                    'type' => GridView::TYPE_DANGER,
                                    'heading' => "<i class='fa fa-book'></i> " . $this->title."(จ้างบริษัทรถร่วม)",
                                ]
                            ]);
                            ?>

                        </div>

                        <?php
                        $this->registerJs("
        $(document).ready(function(){
        $('#print_bill').click(function(){
            //var url = $('#url').val();
            var cus_id = $('#cus_id').val();
            var Id = $('#assign').yiiGridView('getSelectedRows');
            var Id2 = $('#assign_out').yiiGridView('getSelectedRows');
            //alert(Id2);
            var url = 'index.php?r=order-transport/print_bill_customer&Id=' + Id + '&Id2=' + Id2 + '&cus_id=' + cus_id;
            window.open(url);
        });
        });");
                        ?>
                        <input type="hidden" id="cus_id" value="<?php echo $cus_id; ?>"/>
                        <input type="hidden" id="url" value="<?php echo Url::to(['order-transport/print_bill_customer']) ?>"/>

<!--

$.ajax({
            type: 'POST',
            url : url,
            data : {
                assign_id: Id,
                cus_id: cus_id
            },
            success : function() {
              $(this).closest('tr').remove(); 
            }
        });
-->