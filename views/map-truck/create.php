<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MapTruck */

$this->title = 'จับคู่รถ';
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (!empty($error)) { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-warning"></i> <?php echo $error; ?>
    </div>
<?php } ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-windows"></i> <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="well">
            <label>หัวลาก</label>
            <select id="truck_1" class="form-control" required="required">
                <option value="">== เลือกรถ ==</option>
                <?php foreach ($truck1 as $t1): ?>
                    <option value="<?php echo $t1['license_plate'] ?>"><?php echo $t1['license_plate'] ?></option>
                <?php endforeach; ?>
            </select>
            <label>พ่วง</label>
            <select id="truck_2" class="form-control" required="required">
                <option value="">== เลือกรถ ==</option>
                <?php foreach ($truck2 as $t2): ?>
                    <option value="<?php echo $t2['license_plate'] ?>"><?php echo $t2['license_plate'] ?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <button type="button" class="btn btn-success" onclick="save()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
        </div>

        <button type="button" class="btn btn-default btn-sm" style=" padding: 0px 5px;"><i class="fa fa-user-plus text-green"></i></button> = เพิ่มคนขับ
        <button type="button" class="btn btn-warning btn-sm" style=" padding: 0px 5px;"><i class="fa fa-exchange"></i></button> = เปลี่ยนคนขับ
        <i class="fa fa-eye"></i> = ดูข้อมูล
        <i class="fa fa-edit"></i> = แก้ไขข้อมูล
        <i class="fa fa-trash"></i> = ลบข้อมูล

        <br/><br/>
        <div id="result_map_truck" class="table table-responsive"></div>
    </div>

</div>


<!-- 
Dialog คนขับรถที่ยังไม่มีรถขับประจำ 
-->

<div class="modal modal-defalut" id="dialog_driver">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-user"></i> เลือกพนักงานขับรถประจำ[คันที่ <font id="car_number"></font>]</h4>
            </div>
            <div class="modal-body">
                <div id="result_dialog_driver"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$this->registerJs(' 
        get_map_truck();
            ');
?>

<script type="text/javascript">
    function get_map_truck() {
        $("#result_map_truck").html('<i class="fa fa-spinner fa-spin"></i>');
        var url = "<?php echo Url::to(['map-truck/view']) ?>";
        var data = {a: 1};

        $.post(url, data, function (result) {
            $("#result_map_truck").html(result);
        });
    }

    function save() {
        var url = "<?php echo Url::to(['map-truck/save']) ?>";
        var truck_1 = $("#truck_1").val();
        var truck_2 = $("#truck_2").val();

        if (truck_1 == '' || truck_2 == '') {
            sweetAlert("แจ้งเตือน...", "คุณกรอกข้อมูลยังไม่ครบ!", "warning");
            return false;
        }
        var data = {truck_1: truck_1, truck_2: truck_2};

        $.post(url, data, function (result) {
            window.location.reload();
            //get_map_truck();
        });
    }


    //Dialog Driver 
    function dialog_driver(car_id) {
        $("#car_number").text(car_id);
        $("#result_dialog_driver").html('<i class="fa fa-spinner fa-spin"></i>');
        var url = "<?php echo Url::to(['map-truck/list_driver']) ?>";
        var data = {car_id: car_id};

        $.post(url, data, function (result) {
            $("#dialog_driver").modal();
            $("#result_dialog_driver").html(result);
        });
    }
</script>