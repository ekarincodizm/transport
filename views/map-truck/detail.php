<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MapTruck */

$this->title = 'ข้อมูลรถคันที่ ' . $model['car_id'];
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-warning">
    <div class="panel-heading">
        <i class="fa fa-windows"></i> <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <?php echo $model['truck_1'] ?>
                    </div>
                    <div class="panel-body">
                        <div id="detail_truck1"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <?php echo $model['truck_2'] ?>
                    </div>
                    <div class="panel-body">
                        <div id="detail_truck2"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<?php
$this->registerJs(' 
        get_detail_truck();
        get_detail_truck2();
            ');
?>

<script type="text/javascript">

    function save() {
        var url = "<?php echo Url::to(['map-truck/save_update']) ?>";
        var truck_1 = $("#truck_1").val();
        var truck_2 = $("#truck_2").val();
        var car_id = "<?php echo $model['car_id'] ?>";

        if (truck_1 == '' || truck_2 == '') {
            sweetAlert("แจ้งเตือน...", "คุณกรอกข้อมูลยังไม่ครบ!", "warning");
            return false;
        }
        var data = {
            truck_1: truck_1,
            truck_2: truck_2,
            car_id: car_id
        };

        $.post(url, data, function (result) {
            sweetAlert("Success...", "แก้ไขข้อมูลแล้ว!", "success");
            window.location.reload();
        });
    }

    function get_detail_truck() {
        var url = "<?php echo Url::to(['truck/get_detail_truck']) ?>";
        var truck_1 = "<?php echo $model['truck_1'] ?>";
        var data = {license_plate: truck_1};

        $.post(url, data, function (result) {
            $("#detail_truck1").html(result);
        });

    }

    function get_detail_truck2() {
        var url = "<?php echo Url::to(['truck/get_detail_truck']) ?>";
        var truck_2 = "<?php echo $model['truck_2'] ?>";
        var data = {license_plate: truck_2};

        $.post(url, data, function (result) {
            $("#detail_truck2").html(result);
        });

    }

</script>