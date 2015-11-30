<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\DesktopAsset;
use app\assets\JsAsset;
use yii\helpers\Url;
use yii\web\Session;

if (Yii::$app->session['themes'] == "") {
    Yii::$app->session['themes'] = "content-bg-gray";
}


DesktopAsset::register($this);
JsAsset::register($this);
$this->title = "ตงตงทรานสปอร์ต";
$driver_model = new \app\models\Driver();
$truck_act = new \app\models\TruckAct();
$annuities = new app\models\Annuities();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <script>
            function startTime() {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('txt').innerHTML =
                        h + "<br/>" + m + ":" + s;
                var t = setTimeout(startTime, 500);
            }
            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }
                ;  // add zero in front of numbers < 10
                return i;
            }
        </script>

    </head>
    <body class="skin-blue sidebar-collapse" onload="startTime();">
        <?php $this->beginBody() ?>

        <div class="wrapper">

            <!-- Left side column. contains the logo and sidebar 
            <aside class="main-sidebar" id="bg-sidebar" style=" padding-top: 5px;">
                <section class="sidebar" style=" padding-bottom: 50px;">
                    <ul class="sidebar-menu">
                        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                        <li class="header"><i class="fa fa-cogs"></i> ตั้งค่าระบบ</li>
                        <li><a href="<?//php echo Url::to(['truck/index']); ?>"><i class="fa fa-car text-red"></i> <span>ข้อมูลรถ</span></a></li>
                        <li><a href="<?//php echo Url::to(['driver/index']); ?>"><i class="fa fa-users text-yellow"></i> <span>ข้อมูลคนขับ</span></a></li>
                        <li><a href="<?//php echo Url::to(['customer/index']); ?>"><i class="fa fa-building text-aqua"></i> <span>ข้อมูลลูกค้า</span></a></li>
                        <li><a href="<?//php echo Url::to(['affiliated/index']); ?>"><i class="fa fa-building-o text-yellow"></i> <span>บริษัทรถร่วม</span></a></li>
                        <li><a href="<?//php echo Url::to(['typecar/index']); ?>"><i class="fa fa-bus text-green"></i> <span>ประเภทรถ</span></a></li>
                        <li><a href="<?//php echo Url::to(['product-type/index']); ?>"><i class="fa fa-shopping-cart text-danger"></i> <span>ประเภทสินค้า</span></a></li>
                        <li><a href="<?//php echo Url::to(['company/index']); ?>"><i class="fa fa-university text-success"></i> <span>ข้อมูลบริษัท</span></a></li>
                        <li><a href="<?//php echo Url::to(['notifications/view', 'id' => '1']); ?>"><i class="fa fa-bell text-orange"></i> <span>ตั้งค่าการแจ้งเตือน</span></a></li>
                        <li class="header"><i class="fa fa-book"></i> รายงาน</li>
                        <li><a href="#"><i class="fa fa-bar-chart text-danger"></i> <span>รับ - จ่าย(รายปี)</span></a></li>
                        <li><a href="#"><i class="fa fa-bar-chart text-success"></i> <span>รับ - จ่าย(รายเดือน)</span></a></li>
                    </ul>
                </section>
                sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="<?php echo Yii::$app->session['themes']; ?>" style=" padding-bottom: 50px; padding-top: 10px;">
            <!-- Content Header (Page header) -->
            <!--
            <section class="content-header" style="margin: 0px;padding: 0px; border-radius: 0px;">
                <h4 style="margin: 0px; font-size: 14px;" class="navicator">
            <?php
            //echo Yii::$app->request->baseUrl;
            ?>
            <?php
            /*
              echo Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              ])
             * 
             */
            ?>
                </h4>
            </section>
            -->
            <!-- Main content -->
            <section class="content" style=" margin-top: 0px; padding-top: 0px;">
                <?= $content ?>
            </section><!-- /.content -->


        </div><!-- /.content-wrapper -->
        <footer class="navbar navbar-inverse navbar-fixed-bottom" style="border-radius:0px;" id="bg-nav-bottom-dark">
            <div class="container-" style="padding-top: 8px; padding-left: 0px;">

                <div class="row" style=" margin: 0px; padding-left: 0px;">
                    <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
                        <!--
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" id="sidebar-toggle">
                            <div class="btn btn-default btn-block"><i class="fa fa-bars text-green"></i> MENU</div>
                        </a>
                        -->

                        <div class="dropup">
                            <button class="btn btn-info btn-block dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-windows"></i> เมนู
                            </button>
                            <ul class="dropdown-menu pull-left" aria-labelledby="dropdownMenu2" style="width: 250px;" id="menu-task-bar">
                                <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                                <li><a href="<?php echo Url::to(['site/index']); ?>"><i class="fa fa-home"></i> <span>หน้าแรก</span></a></li>
                                <li class="header"><i class="fa fa-cogs"></i> ตั้งค่าระบบ</li>
                                <li class="active"><a href="<?php echo Url::to(['truck/index']); ?>"><i class="fa fa-car text-red"></i> <span>ข้อมูลรถ</span></a></li>
                                <li><a href="<?php echo Url::to(['driver/index']); ?>"><i class="fa fa-users text-yellow"></i> <span>ข้อมูลคนขับ</span></a></li>
                                <li><a href="<?php echo Url::to(['customer/index']); ?>"><i class="fa fa-building text-aqua"></i> <span>ข้อมูลลูกค้า</span></a></li>
                                <li><a href="<?php echo Url::to(['affiliated/index']); ?>"><i class="fa fa-building-o text-yellow"></i> <span>บริษัทรถร่วม</span></a></li>
                                <li><a href="<?php echo Url::to(['typecar/index']); ?>"><i class="fa fa-bus text-green"></i> <span>ประเภทรถ</span></a></li>
                                <li><a href="<?php echo Url::to(['product-type/index']); ?>"><i class="fa fa-shopping-cart text-danger"></i> <span>ประเภทสินค้า</span></a></li>
                                <li><a href="<?php echo Url::to(['company/index']); ?>"><i class="fa fa-university text-success"></i> <span>ข้อมูลบริษัท</span></a></li>
                                <li><a href="<?php echo Url::to(['notifications/view', 'id' => '1']); ?>"><i class="fa fa-bell text-orange"></i> <span>ตั้งค่าการแจ้งเตือน</span></a></li>
                                <li class="header"><i class="fa fa-book"></i> รายงาน</li>
                                <li><a href="<?php echo Url::to(['report/report_incom_expenses'])?>"><i class="fa fa-bar-chart text-danger"></i> <span>รับ - จ่าย</span></a></li>
                                <li><a href="#"><i class="fa fa-bar-chart text-success"></i> <span>รับ - จ่าย(รายเดือน)</span></a></li>
                                <li style=" border-top: #000 solid 1px;">

                                </li>
                                <li class="pull-right" style=" padding: 5px;">
                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i> ออกจากระบบ</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9" id="noti">
                        <section class="content-header" style="margin: 0px;padding: 0px; border-radius: 0px;">
                            <h4 style="margin: 0px; font-size: 14px;" class="navicator">
                                <?=
                                Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ])
                                ?>
                            </h4>
                        </section>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                        <div class="dropup">
                            <button class="btn btn-warning btn-block dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                แจ้งเตือน
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu2">
                                <li>
                                    <a href="<?php echo Url::to(['truck-act/notification']) ?>">
                                        <i class="fa fa-bell-o text-red"></i> พรบ/ภาษี
                                        <span class="label label-warning pull-right">
                                            <?php echo $truck_act->notification_act(); ?>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Url::to(['driver/driver_license_expire']) ?>">
                                        <i class="fa fa-credit-card text-blue"></i> ใบขับขี่
                                        <span class="label label-danger pull-right"><?php echo $driver_model->Get_license_expire(); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Url::to(['annuities/list_over']) ?>">
                                        <i class="fa fa-truck text-green"></i> ค่างวด
                                        <span class="label label-danger pull-right"><?php echo $annuities->count_over(); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://theassembler.net"></a>.</strong> All rights reserved.
            -->
        </footer>

        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <?php
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
    //$this->endBody();
    ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        if (width <= 768) {
            $("#noti").hide();
        } else {
            $("#noti").show();
        }
        // Add slideDown animation to dropdown
        $('.dropdown').on('show.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).fadeIn('fast');
        });

// Add slideUp animation to dropdown
        $('.dropdown').on('hide.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).fadeOut();
        });

        // Add slideDown animation to dropdown
        $('.dropup').on('show.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown('fast');
        });

// Add slideUp animation to dropdown
        $('.dropup').on('hide.bs.dropdown', function (e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
        });
    });
</script>





