<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'ตงตงทรานสปอร์ต';
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 style="margin: 5px 0px;"><?php echo $this->title; ?></h1>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <button type="button" class="btn btn-default" style=" width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <img src="<?php echo Url::to('@web/web/images/data-transport-icon.png') ?>"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style=" text-align: left;">
                    <h1>ขนส่งโดยใช้รถภายใน</h1>
                    <h4>(ใบงานการขนส่งโดยใช้รถของบริษัท)</h4>
                </div>
            </div>
        </button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <button type="button" class="btn btn-default" style=" width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <img src="<?php echo Url::to('@web/web/images/company-building-icon.png') ?>"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="text-align: left;">
                    <h1>ขนส่งโดยใช้รถบริษัทข้างนอก</h1>
                    <h4>(ใบงานการขนส่งโดยใช้รถของบริษัทภายนอก)</h4>
                </div>
            </div>
        </button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <button type="button" class="btn btn-default" style=" width: 100%;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <img src="<?php echo Url::to('@web/web/images/Car-Repair-icon.png') ?>"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="text-align: left;">
                    <h1>ซ่อมบำรุง</h1>
                    <h4>(บันทึกรายการซ่อมบำรุงรถ)</h4>
                </div>
            </div>
        </button>
    </div>
</div>
