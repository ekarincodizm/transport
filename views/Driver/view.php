<style tyle="text/css">
    .croppic{
        max-width:200px;
        min-height:250px;
        background: #FFF;
    }
</style>
<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'พนักงานขับรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-view">

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">ข้อมูลทั่วไป</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">ประวัติการวิ่งรถ</a></li>
            <li role="presentation"><a href="#chart" aria-controls="chart" role="tab" data-toggle="tab">ภาพรวม</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $this->title; ?>
                        <div style="text-align: right; float: right;">
                            <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => '']) ?>
                            <?=
                            Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <center>
                                    <div id="cropContaineroutput" class="croppic">
                                        <img src="<?php echo Url::to('@web/web/uploads/profile/' . $model->images) ?>" class="img-responsive"/>
                                    </div>

                                </center>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" >
                                <?=
                                DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'id',
                                        'name',
                                        'lname',
                                        'card_id',
                                        'address',
                                        'tel1',
                                        'tel2',
                                        'driver_license_id',
                                        'driver_license_expire',
                                        'create_date'
                                    ],
                                ])
                                ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">2</div>
            <div role="tabpanel" class="tab-pane" id="chart">3</div>
        </div>

    </div>

</div>

<script>

</script>
<?php
$url = Url::to(['driver/img_crop_to_file', 'id' => $model->id]);
$this->registerJs(
        "var croppicContaineroutputOptions = {
        uploadUrl: '" . Yii::$app->urlManager->createUrl('driver/img_save_to_file') . "',
        cropUrl: '" . $url . "',
        outputUrlId: 'cropOutput',
        modal: false,
        loaderHtml: '<div class=\"loader bubblingG\"><span id=\"bubblingG_1\"></span><span id=\"bubblingG_2\"></span><span id=\"bubblingG_3\"></span></div> ',
        onBeforeImgUpload: function () {
            console.log('onBeforeImgUpload')
        },
        onAfterImgUpload: function () {
            console.log('onAfterImgUpload')
        },
        onImgDrag: function () {
            console.log('onImgDrag')
        },
        onImgZoom: function () {
            console.log('onImgZoom')
        },
        onBeforeImgCrop: function () {
            console.log('onBeforeImgCrop')
        },
        onAfterImgCrop: function () {
            window.location.reload();
            console.log('onAfterImgCrop')
        },
        onReset: function () {
            console.log('onReset')
        },
        onError: function (errormessage) {
            console.log('onError:' + errormessage)
        }
    }

    var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);
"
);
?>