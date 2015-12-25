<style type="text/css">
    body{color: #666666; font-size: 12px;}
    table tr td{ border-left: #000 solid 1px; border-bottom: #000 solid 1px; padding: 5px;}
    table tr th{ border-left: #000 solid 1px; border-bottom: #000 solid 1px; border-top: #000 solid 1px; padding: 5px; text-align: left; font-weight: normal;}
    table{ border-right: #000 solid 1px;}
    table tr th p{ margin-bottom: 10px;}
    #line{ color: #FFF; font-size: 5px;}
</style>
<?php

use yii\helpers\Url;

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$producttype_model = new app\models\ProductType();
$thaibaht = new app\models\Thaibaht();

$company_model = new \app\models\Company();
$company = $company_model->find()->one();
?>
<!--
    #ข้อมูลใบปฏิบัติงาน
    Comment By Kimniyom
-->
<div style=" position: absolute; left: 50px; top: 30px;">
    <div style="width: 80px;">
        <img src="<?php echo Url::to('@web/web/images/logo.jpg', true) ?>"/>
    </div>
</div>

<div style="float: left; padding-top:50px;">
    <font style=" font-size: 12px;">
    <b><?php echo $company['companyname'] ?></b><br/>
    <?php echo $company['address'] ?><br/>
    <?php echo $company['contact'] ?><br/>
    เลขประจำตัวผู้เสียภาษี <?php echo $company['taxation_number'] ?><br/>
    </font>
</div>

<div style="float:right; top: 20px; position: absolute; right: 50px; text-align: center; font-weight: bold;">
    <p>สำเนา/Copy</p>
    <p>รายการขนส่ง</p>
    <p>วันที่พิใพ์ <?php echo date("Y-m-d H:i:s"); ?></p>
</div>

<br/>

<table class="table table-bordered" style="width:100%;border-top: #000 solid 1px;" cellpadding="1" cellspacing="0" width="100%">
    <tr>
        <td colspan="2" valign='top'>
            <?php $employer = $customer_model->find()->where(['cus_id' => $model->employer])->one() ?>
            <b>ลูกค้า :</b> <?php echo $employer['company']; ?>
            <div id="line">.</div>
            <b>ที่อยู่ : </b> <?php echo $employer['address']; ?>
        </td>
        <td colspan="2" valign='top'>
            <b>เลขที่ Invoice No.:</b>
            <div id="line">.</div>
            <b>วันที่ Invoice Date :</b>
        </td>
        <td valign='top' style=" text-align: right;">
            <?php echo $model['assign_id']; ?>
            <div id="line">.</div>
            <?php echo $config->thaidate($model['order_date_start']); ?>
        </td>
    </tr>
    <thead>
        <tr>
            <th style=" text-align: center; width: 5%;">#</th>
            <th style="text-align:center; width: 65%;">รายการ</th>
            <th style=" text-align: center; width: 10%;">จำนวน</th>
            <th style="text-align:center; width: 10%;">หน่วยละ</th>
            <th style="text-align:center; width: 15%;">จำนวนเงินสุทธิ(บาท)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center;" valign="top">1</td>
            <td>
                - ค่าข่นส่งสินค้า <?php echo $producttype_model->find()->where(['id' => $model['product_type']])->one()['product_type']; ?>
                <div id="line">.</div>
                - ต้นทาง <?php echo $customer_model->find()->where(['cus_id' => $model['cus_start']])->one()['company']; ?>
                ปลายทาง <?php echo $customer_model->find()->where(['cus_id' => $model['cus_end']])->one()['company']; ?>
                <div id="line">.</div>
                - เส้นทาง <?php echo $changwat_model->find()->where(['changwat_id' => $model['changwat_start']])->one()['changwat_name']; ?>
                - <?php echo $changwat_model->find()->where(['changwat_id' => $model['changwat_end']])->one()['changwat_name']; ?>
            </td>
            <td style=" text-align: center;" valign='top'><?php echo $model['weigh'] ?></td>
            <td style=" text-align: right;" valign='top'><?php echo number_format($model['unit_price'], 2) ?></td>
            <td style=" text-align: right;" valign="top"><?php echo number_format($model['income'], 2); ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center; font-weight: bold;" colspan="4">
                รวมทั้งสิ้น
            </td>
            <td style=" text-align: right; font-weight: bold;" valign='bottom'>
                <?php echo number_format($model['income'], 2); ?>
            </td>
        </tr>
        <tr>
            <td colspan="5" style=" text-align: right; font-weight: bold;">
                <b>( <?php echo $thaibaht->convert($model['income']); ?> )</b>
            </td>
        </tr>

        <tr>
            <td colspan="5" style=" text-align: center;">
                ในนาม <?php echo $company['companyname'] ?>
            </td>
        </tr>

    </tfoot>
</table>

<!--
    ###################### END #########################
-->
