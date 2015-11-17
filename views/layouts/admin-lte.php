<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AdminLteAsset;
use app\assets\JsAsset;
use yii\helpers\Url;

AdminLteAsset::register($this);
JsAsset::register($this);
$this->title = "ตงตงทรานสปอร์ต";
$driver_model = new \app\models\Driver();
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
    </head>
    <body class="skin-blue-light fixed">
        <?php $this->beginBody() ?>

        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo" id="bg-nav">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b><img src="<?php echo Url::to("@web/web/images/logo.jpg") ?>" width="32"/></b> ตงตงทรานสปอร์ต</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation" id="bg-nav">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i> พรบ/ภาษี
                                    <span class="label label-warning">10</span>
                                </a>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                <a href="<?php echo Url::to(['driver/driver_license_expire'])?>" class="dropdown-toggle">
                                    <i class="fa fa-credit-card"></i> ใบขับขี่
                                    <span class="label label-danger"><?php echo $driver_model->Get_license_expire(); ?></span>
                                </a>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo Url::to('@web/web/images/A_LOGO.png'); ?>" class="user-image" alt="User Image" />
                                    <span class="hidden-xs">The Assembler</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo Url::to('@web/web/images/A_LOGO.png'); ?>" class="img-circle" alt="User Image" />
                                        <p>
                                            Developer
                                            <small>The Assembler Theme</small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <a href="http://www.theassembler.net" target="_black" class="btn btn-default btn-flat btn-block">Developer</a>                                        
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar" id="bg-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->

                    <ul class="sidebar-menu">
                        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                        <li class="header"><i class="fa fa-cogs"></i> ตั้งค่าระบบ</li>
                        <li><a href="<?php echo Url::to(['truck/index']); ?>"><i class="fa fa-car text-red"></i> ข้อมูลรถ</a></li>
                        <li><a href="<?php echo Url::to(['driver/index']); ?>"><i class="fa fa-users text-yellow"></i> ข้อมูลคนขับ</a></li>
                        <li><a href="<?php echo Url::to(['customer/index']); ?>"><i class="fa fa-building text-aqua"></i> ข้อมูลลูกค้า</a></li>
                        <li><a href="<?php echo Url::to(['affiliated/index']); ?>"><i class="fa fa-building-o text-yellow"></i> บริษัทรถร่วม</a></li>
                        <li><a href="<?php echo Url::to(['typecar/index']); ?>"><i class="fa fa-bus text-green"></i> ประเภทรถ</a></li>
                        <li><a href="<?php echo Url::to(['product-type/index']); ?>"><i class="fa fa-shopping-cart text-danger"></i> ประเภทสินค้า</a></li>
                        <li><a href="<?php echo Url::to(['company/index']); ?>"><i class="fa fa-university text-success"></i> ข้อมูลบริษัท</a></li>
                        <li class="header"><i class="fa fa-book"></i> รายงาน</li>
                        <li><a href="#"><i class="fa fa-bar-chart text-danger"></i> รับ - จ่าย(รายปี)</a></li>
                        <li><a href="#"><i class="fa fa-bar-chart text-success"></i> รับ - จ่าย(รายเดือน)</a></li>
                    </ul>


                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="margin: 0px;padding: 0px; border-radius: 0px;">
                    <h4 style="margin: 0px; font-size: 14px;">
                        <?php
                        //echo Yii::$app->request->baseUrl;
                        ?>
                        <?=
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                        ?>
                    </h4>
                </section>

                <!-- Main content -->
                <section class="content" style=" margin-top: 0px; padding-top: 0px;">
                    <?= $content ?>
                </section><!-- /.content -->


            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.2.0
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://theassembler.net"></a>.</strong> All rights reserved.
            </footer>

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>



