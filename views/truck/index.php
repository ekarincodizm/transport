<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รถบรรทุก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);      ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> เพิ่มรถบรรทุก', ['create'], ['class' => 'btn btn-default']) ?>
    </p>

    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'license_plate',
        'brand',
        'model',
        'color',
        // 'date_buy',
        // 'price',
        // 'down',
        // 'period_price',
        // 'period',
        // 'date_supply',
        //'type_id',
        [
            'attribute' => 'price',
            //'width' => '200px',
            'format' => 'raw',
            'header' => 'ราคา',
            'hAlign' => 'right',
            'mergeHeader' => true,
            'value' => function ($model) {
                return number_format($model->price);
            },
        ],
        [
            'attribute' => 'type_id',
            'width' => '200px',
            'value' => function ($model) {
                return \app\models\Typecar::find()->where(['id' => $model->type_id])->one()['type_name'];
            },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(\app\models\Typecar::find()->orderBy('type_name')->asArray()->all(), 'id', 'type_name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'ประเภทรถ'],
                //'group'=>true,  // enable grouping
                ],
                [
                    'attribute' => 'status',
                    'hAlign' => 'center',
                    'format' => 'raw',
                    'label' => 'สถานะ',
                    'mergeHeader' => true,
                    'value' => function ($model) {
                        if ($model->status == '1') {
                            $status = "<font style='color:red'><i class='fa fa-remove'></i> ถูกจำหน่าย</font>";
                        } else {
                            $status = "<font style='color:green'><i class='fa fa-check'></i> ใช้งานได้</font>";
                        }
                        return $status;
                    },
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'ตัวเลือก',
                    'template' => '{view} {update} {delete} ',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                            '<span class="glyphicon glyphicon-eye-open"></span>', $url);
                        },
                        'update' => function ($url, $model) {
                            //$sql = "SELECT COUNT(*) AS TOTAL FROM map_truck WHERE (truck_1 = '$model->license_plate' OR truck_2 = '$model->license_plate'  )";
                            //$check = Yii::$app->db->createCommand($sql)->queryOne();
                            if ($model->status == '1') {
                                $url = "javascript:alert('ไม่สามารถแก้ไขข้อมูลนี้ได้ ... !')";
                            }
                            return Html::a(
                                            '<span class="glyphicon glyphicon-pencil"></span>', $url);
                        },
                        'delete' => function ($url, $model) {
                            $sql = "SELECT COUNT(*) AS TOTAL FROM map_truck WHERE (truck_1 = '$model->license_plate' OR truck_2 = '$model->license_plate'  )";
                            $check = Yii::$app->db->createCommand($sql)->queryOne();
                            if ($model->status == '1' || $check['TOTAL'] > 0) {
                                $url = "javascript:alert('ไม่สามารถลบข้อมูลนี้ได้ ... !')";
                            } else {
                                $url = "javascript:confirm_delete('$model->id')";
                                //$url = "";
                            }
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url);
                        },
                    ],
                /*
                  'header' => 'ตัวเลือก',
                  'viewOptions' => ['title' => 'ดูข้อมูล', 'data-toggle' => 'tooltip'],
                  'updateOptions' => ['title' => 'แก้ไข', 'data-toggle' => 'tooltip'],
                  'deleteOptions' => ['title' => 'ลบ', 'data-toggle' => 'tooltip'],
                  'headerOptions' => ['class' => 'kartik-sheet-style'],
                 * 
                 */
                ],
            ];
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'responsive' => true,
                'pjax' => true, // pjax is set to always true for this demo
                'panel' => [
                    'type' => GridView::TYPE_DEFAULT,
                    'heading' => "<i class='fa fa-truck'></i> " . $this->title,
                ],
            ]);
            ?>

        </div>

        <script type="text/javascript">
            function confirm_delete(id) {
                var r = confirm('คุณแน่ใจหรือไม่ ...?');
                if (r == true) {
                    var url = "<?php echo Url::to(['truck/delete_truck']) ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
