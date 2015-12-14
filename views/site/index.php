<style type="text/css">
    @media (min-width: 768px) {
        .box-menu {
            height: 190px;
            background: #000;
        }
        .box-menu-first{
            height: 400px;
            background: #6ba610;
        }
    }
</style>

<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'ตงตงทรานสปอร์ต';
$config = new \app\models\Config_system();
?>

<div class="row" id="text-color">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div style="position: absolute; top: 5px; right: 5px;">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-cog"></i>
                </button>
                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a href="Javascript:set_bg('gray')">Gray <div class="btn pull-right" id="content-bg-gray"></div></a></li>
                    <li><a href="Javascript:set_bg('red')">Red <div class="btn pull-right" id="content-bg-red"></div></a></li>
                    <li><a href="Javascript:set_bg('green')">Green <div class="btn pull-right" id="content-bg-green"></div></a></li>
                    <li><a href="Javascript:set_bg('blue')">Blue <div class="btn pull-right" id="content-bg-blue"></div></a></li>
                    <li><a href="Javascript:set_bg('green-dark')">Green-Dark <div class="btn pull-right" id="content-bg-green-dark"></div></a></li>
                    <li><a href="Javascript:set_bg('blue-dark')">Blue-Dark <div class="btn pull-right" id="content-bg-blue-dark"></div></a></li>
                    <li><a href="Javascript:set_bg('dark')">Dark <div class="btn pull-right" id="content-bg-dark"></div></a></li>
                </ul>
            </div>
        </div>
        <h1 style="margin: 5px 0px;">
            <img src="<?php echo Url::to('@web/web/images/City-Truck-icon.png') ?>"/>
            <?php echo $this->title; ?>
        </h1>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           
                <div class="thumbnail box-menu-first btn btn-success">
                    <img src="<?php echo Url::to('@web/web/images/logo-tt.png') ?>"/>
                    <div class="caption" style=" text-align: center;">
                        <h4><?php echo $this->title; ?></h4>
                    </div>
                </div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <a href="<?php echo Url::to(['order-transport/index']) ?>" 
               data-toggle="tooltip" data-placement="top"
               title="(ใบงานการขนส่งโดยใช้รถของบริษัท)">
                <div class="thumbnail box-menu" id="btn">
                    <img src="<?php echo Url::to('@web/web/images/data-transport-icon.png') ?>"/>
                    <div class="caption" style=" text-align: center;">
                        <h4>ขนส่งโดยใช้รถภายใน</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <a href="<?php echo Url::to(['orders-transport-affiliated/index']) ?>"
               data-toggle="tooltip" data-placement="top"
               title="(ใบงานการขนส่งโดยใช้รถของบริษัทภายนอก)">
                <div class="thumbnail box-menu" id="btn">
                    <img src="<?php echo Url::to('@web/web/images/company-building-icon.png') ?>"/>
                    <div class="caption" style=" text-align: center;">
                        <h4>ขนส่งโดยใช้รถบริษัทรถร่วม</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <a href="javascript:popup_truck()"
               data-toggle="tooltip" data-placement="top"
               title="(บันทึกรายการซ่อมบำรุงรถ)">
                <div class="thumbnail box-menu" id="btn">
                    <img src="<?php echo Url::to('@web/web/images/Car-Repair-icon.png') ?>"/>
                    <div class="caption">
                        <h4>ซ่อมบำรุง</h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <a href="javascript:popup_driver()"
               data-toggle="tooltip" data-placement="top"
               title="(บันทึก เงินเดือน/รายได้/รายจ่าย พนักงาน)">
                <div class="thumbnail box-menu" id="btn">
                    <img src="<?php echo Url::to('@web/web/images/Account-icon.png') ?>"/>
                    <div class="caption">
                        <h4>(รายได้ - รายจ่าย) พนักงาน</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <a href="javascript:popup_customer()"
               data-toggle="tooltip" data-placement="top"
               title="(ออกบิลใบแจ้งหนี้เรียกเก็บค่าขนส่งจากลูกค้า)">
                <div class="thumbnail box-menu" id="btn">
                    <img src="<?php echo Url::to('@web/web/images/bill-icon.png') ?>"/>
                    <div class="caption">
                        <h4>(ออกบิลใบแจ้งหนี้)</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="thumbnail box-menu" id="btn">
                    <div class="caption">
                            <div id="txt" style="font-size:30px; font-weight: bold;"></div>
                            <h3><?php echo $config->thaidateFull(date("Y-m-d"))?></h3>
                    </div>
                </div>
        </div>
        
    </div><!-- End Right -->
</div>

<!---- 
    ############ Model Get ทะเบียนรถ เพื่อบันทึกรายการซ่อม #############
-->
<div class="modal-demo" id="popup-truck" style=" display: none; text-align: left;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="Custombox.close();">
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
<div class="modal-demo" id="popup-driver" style=" display: none; text-align: left;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="Custombox.close();">
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

<!---- 
    ############ Model Get รายชื่อพนักงาน #############
-->
<div class="modal-demo" id="popup-customer" style=" display: none; text-align: left;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="Custombox.close();">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-building-o text-green"></i> เลือกลูกค้า(วางบิลลูกหนี้)</h4>
            </div>
            <div class="modal-body">
                <div id="list-customer"></div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal 
<div id="modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="title">Modal title</h4>
    <div class="text">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
    </div>
</div>
-->
<?php
$this->registerJs("
        $(document).ready(function(){
$(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#bg-nav-head,.sidebar-toggle').fadeOut();
            } else {
                $('#bg-nav-head,.sidebar-toggle').fadeIn();
            }
        });        

        var style = ('background','#000');
       $('body #bg-nav-head').css('background', 'none');
    });
            ");
?>
<script type="text/javascript">
    function popup_truck() {
        //$("#popup-truck").modal();
        Custombox.open({
            target: '#popup-truck',
            effect: 'fall',
            width: 'full',
            position: ['center', 'top'],
        });
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
        //$("#popup-driver").modal();
        Custombox.open({
            target: '#popup-driver',
            effect: 'fall',
            width: 'full',
            position: ['center', 'top'],
        });

        $("#list-driver").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['driver/get_driver']) ?>";
        var data = {a: 1};
        $.post(url, data, function (result) {
            $("#list-driver").html(result);
        });

    }
</script>

<script type="text/javascript">
    function popup_customer() {
        //$("#popup-driver").modal();
        Custombox.open({
            target: '#popup-customer',
            effect: 'fall',
            width: 'full',
            position: ['center', 'top']
        });

        $("#list-customer").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['customer/get_customer']) ?>";
        var data = {a: 1};
        $.post(url, data, function (result) {
            $("#list-customer").html(result);
        });

    }
</script>

<script type="text/javascript">
    function set_bg(theme) {
        var url = "<?php echo Url::to(['config/set_theme']) ?>";
        var data = {theme: theme};
        //alert(theme);
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
</script>






