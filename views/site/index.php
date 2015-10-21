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
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="<?php echo Url::to(['order-transport/index']) ?>">
            <button type="button" class="btn btn-default" style=" width: 100%;">
                <img src="<?php echo Url::to('@web/web/images/data-transport-icon.png') ?>"/>
                <h3>ขนส่งโดยใช้รถภายใน</h3>
                <h4>(ใบงานการขนส่งโดยใช้รถของบริษัท)</h4>   
            </button>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <button type="button" class="btn btn-default" style=" width: 100%;">
            <img src="<?php echo Url::to('@web/web/images/company-building-icon.png') ?>"/>
            <h3>ขนส่งโดยใช้รถบริษัทข้างนอก</h3>
            <h4>(ใบงานการขนส่งโดยใช้รถของบริษัทภายนอก)</h4>
        </button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style=" margin-top: 30px;">
        <button type="button" class="btn btn-default" style=" width: 100%;">
            <img src="<?php echo Url::to('@web/web/images/Car-Repair-icon.png') ?>"/>
            <h3>ซ่อมบำรุง</h3>
            <h4>(บันทึกรายการซ่อมบำรุงรถ)</h4>
        </button>
    </div>
</div>
