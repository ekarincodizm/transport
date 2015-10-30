<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\TransportSidebarAsset;
use app\assets\JsAsset;
use yii\helpers\Url;

TransportSidebarAsset::register($this);
JsAsset::register($this);
$this->title = "ตงตงทรานสปอร์ต";
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
    <body>
        <?php $this->beginBody() ?>


        <div class="wrapper">
            <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg"> 

                <!-- Start Sidebar -->

                <div class="sidebar-wrapper">
                    <div class="logo" align="center">
                        <img src="assets/img/logomini.png">
                    </div>

                    <ul class="nav" style="border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                        <li>
                            <a href="main.php">
                                <i class="pe-7s-home"></i> 
                                หน้าหลัก
                            </a>            
                        </li>
                        <li class='active'>
                            <a href="approveproject.php">
                                <i class="pe-7s-note2"></i> 
                                โครงการที่อนุมัติจากคณะ<br />กรรมการฯ ระดับจังหวัด
                            </a>       
                        </li>
                        <li >
                            <a href="dashboard1.php">
                                <i class="pe-7s-graph"></i> 
                                กรอบวงเงินที่ได้อนุมัติจาก<br />คณะกรรมการฯ ระดับจังหวัด
                            </a>       
                        </li>
                        <li >
                            <a href="dashboard2.php">
                                <i class="pe-7s-graph"></i> 
                                รายงาน จังหวัด/อำเภอ/ตำบล ที่บันทึกข้อมูล
                            </a> <br>       
                        </li>
                    </ul> 
                </div>	
                <!-- End Sidebar -->

            </div>

            <div class="main-panel"><!-- Start main-panel -->
                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">    
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- Start Title Page on top menu -->

                            <a class="navbar-brand" href="#"><i class="fa fa-thumbs-up"></i>&nbsp; โครงการที่อนุมัติจากจังหวัด</a>

                            <!-- End Title Page on top menu  -->
                        </div>
                        <div class="collapse navbar-collapse">       
                            <!-- Start navbar top menu -->

                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="about.php">
                                        <i class="fa fa-info-circle"></i> เกี่ยวกับเว็บไซต์
                                    </a>
                                </li>
                                <!--<li class="dropdown">
                                                <a href="faq.php">
                                                <i class="fa fa-question-circle"></i> คำถามที่พบบ่อย
                                                </a>
                                </li>-->
                                <li>
                                    <a href="contact.php">
                                        <i class="fa fa-phone-square"></i> ข้อมูลการติดต่อ
                                    </a>
                                </li>
                                <li>
                                    <a href="login.php">
                                        <i class="fa fa-key"></i> เข้าสู่ระบบ
                                    </a>
                                </li>
                            </ul>					
                            <!-- End navbar top menu -->
                        </div>
                    </div>
                </nav>


                <div class="content">
                    <div class="container-fluid">    
                        <div class="row">



                            <div class="col-md-14">
                                <?=
                                Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ])
                                ?>
                                <?php echo $content; ?>
                            </div>	


                        </div>       
                    </div>    
                </div>


                <!--   Start Container foot menu   -->

                <footer class="footer">
                    <div class="container-fluid">			
                        <!--
                        <nav class="pull-left">
                                <ul>
                                        <li>
                                                <a href="#">
                                                Home
                                                </a>
                                        </li>
                                        <li>
                                                <a href="#">
                                                Company
                                                </a>
                                        </li>
                                        <li>
                                                <a href="#">
                                                Portfolio
                                                </a>
                                        </li>
                                        <li>
                                                <a href="#">
                                                Blog
                                                </a>
                                        </li>
                                </ul>
                        </nav>
                        -->

                        <p class="copyright pull-right">
                            &copy; 2015 <a href="http://www.dopa.go.th/">ศูนย์สารสนเทศเพื่อการบริหารงานปกครอง กรมการปกครอง</a> กระทรวงมหาดไทย
                        </p>
                    </div>
                </footer>				
                <!--   End Container foot menu   -->

            </div><!-- End main-panel -->   
        </div>


        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
