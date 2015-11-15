<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'ตงตงทรานสปอร์ต';
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 style="margin: 5px 0px;">
            <img src="<?php echo Url::to('@web/web/images/City-Truck-icon.png') ?>"/>
            <?php echo $this->title; ?>
        </h1>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <a href="<?php echo Url::to(['order-transport/index']) ?>">
            <div class="thumbnail" id="btn">
                <img src="<?php echo Url::to('@web/web/images/data-transport-icon.png') ?>"/>
                <div class="caption" style=" text-align: center;">
                    <h3>ขนส่งโดยใช้รถภายใน</h3>
                    <p>(ใบงานการขนส่งโดยใช้รถของบริษัท)</p>   
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="thumbnail" id="btn">
            <img src="<?php echo Url::to('@web/web/images/company-building-icon.png') ?>"/>
            <div class="caption" style=" text-align: center;">
                <h3>ขนส่งโดยใช้รถบริษัทข้างนอก</h3>
                <p>(ใบงานการขนส่งโดยใช้รถของบริษัทภายนอก)</p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <a href="javascript:popup_truck()">
            <div class="thumbnail" id="btn">
                <img src="<?php echo Url::to('@web/web/images/Car-Repair-icon.png') ?>"/>
                <div class="caption">
                    <h3>ซ่อมบำรุง</h3>
                    <p>(บันทึกรายการซ่อมบำรุงรถ)</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <a href="javascript:popup_driver()">
            <div class="thumbnail" id="btn">
                <img src="<?php echo Url::to('@web/web/images/Account-icon.png') ?>"/>
                <div class="caption">
                    <h3>(รายได้ - รายจ่าย) พนักงาน</h3>
                    <p>(บันทึก เงินเดือน/รายได้/รายจ่าย พนักงาน)</p>
                </div>
            </div>
        </a>
    </div>
</div>

<!---- 
    ############ Model Get ทะเบียนรถ เพื่อบันทึกรายการซ่อม #############
-->
<div class="modal" id="popup-truck">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-truck text-green"></i> เลือกรถ</h4>
            </div>
            <div class="modal-body">
                <div id="list-truck-result"></div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!---- 
    ############ Model Get รายชื่อพนักงาน #############
-->
<div class="modal" id="popup-driver">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-users text-green"></i> เลือกพนักงาน</h4>
            </div>
            <div class="modal-body">
                <div id="list-driver"></div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
    function popup_truck() {
        $("#popup-truck").modal();
        $("#list-truck-result").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['truck/get_truck']) ?>";
        var data = {a: 1};
        $.post(url, data, function (result) {
            $("#list-truck-result").html(result);
        });

    }
</script>

<script type="text/javascript">
    function popup_driver() {
        $("#popup-driver").modal();
        $("#list-driver").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['driver/get_driver']) ?>";
        var data = {a: 1};
        $.post(url, data, function (result) {
            $("#list-driver").html(result);
        });

    }
</script>




