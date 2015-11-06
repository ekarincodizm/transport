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
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
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
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail" id="btn">
            <img src="<?php echo Url::to('@web/web/images/company-building-icon.png') ?>"/>
            <div class="caption" style=" text-align: center;">
                <h3>ขนส่งโดยใช้รถบริษัทข้างนอก</h3>
                <p>(ใบงานการขนส่งโดยใช้รถของบริษัทภายนอก)</p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail" id="btn">
            <img src="<?php echo Url::to('@web/web/images/Car-Repair-icon.png') ?>"/>
            <div class="caption">
                <h3>ซ่อมบำรุง</h3>
                <p>(บันทึกรายการซ่อมบำรุงรถ)</p>
            </div>
        </div>
    </div>
</div>




