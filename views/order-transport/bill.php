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

$account_model = new \app\models\Account();
$account = $account_model->find()->where(['status' => 1])->one();
?>
<!--
    #ข้อมูลใบปฏิบัติงาน
    Comment By Kimniyom
-->
<div style=" position: absolute; left: 50px; top: 30px;">
    <div style="width: 80px;">
        <img src="<?php echo Url::to('@web/web/uploads/logo/' . $company['logo'], true) ?>"/>
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

<div style="float:right; top: 20px; position: absolute; right: 50px; font-weight: bold;">
    <center>
        <p>สำเนา/Copy</p>
        <p>ใบวางบิล [Statement]</p>
        <p>ลูกค้า [Customer]</p>
    </center>
</div>

<br/>

<div class="well" style=" border: #000 solid 1px; padding: 0px; border-bottom: none; position: relative;">
    <div style="width: 49%; float: left; padding-left: 5px;">
        <?php $employer = $customer_model->find()->where(['cus_id' => $model->employer])->one() ?>
        <b>ผู้ว่าจ้าง :</b> <?php echo $employer['company']; ?>  <br/>
        <b>ที่อยู่ : </b> <?php echo $employer['address']; ?><br/>
        <b>Tel : </b> <?php echo $employer['tel']; ?>
    </div>
    <div style="width:49%; float: right; border-left: #000000 solid 1px;">
        <div style=" text-align: left; float: left; width: 50%; border-right: #000 solid 1px; padding-left: 5px;">
            <b>เลขที่ Invoice No.:</b><br/>
            <b>วันที่ Invoice Date :</b>
        </div>
        <div style=" text-align: center; float: left; width: 46%;">
            <?php echo $model->assign_id; ?><br/>
            <?php echo $config->thaidate($model->order_date_start); ?>
        </div>
        <div style="text-align: left; width: 100%; border-top: #000 solid 1px; padding: 5px;">
            <?php echo $account['bank_name'] ?>
            สาขา <?php echo $account['brance'] ?><br/>
            บัญชีเลขที่ <?php echo $account['account_number'] ?><br/>
            <?php echo $account['account_name'] ?>
        </div>
    </div>
</div>

<table class="table table-bordered" style="width:100%;" cellpadding="1" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style=" text-align: center; width: 5%;">#</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">จำนวนเงินสุทธิ(บาท)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center;" valign="top">1</td>
            <td>
                - ค่าข่นส่งสินค้า <?php echo $producttype_model->find()->where(['id' => $model->product_type])->one()['product_type']; ?>
                <div id="line">.</div>
                - ขึ้นของ <?php echo $customer_model->find()->where(['cus_id' => $model->cus_start])->one()['company']; ?>
                ลงของ <?php echo $customer_model->find()->where(['cus_id' => $model->cus_end])->one()['company']; ?>
                <div id="line">.</div>
                - เส้นทาง <?php echo $changwat_model->find()->where(['changwat_id' => $model->changwat_start])->one()['changwat_name']; ?>
                - <?php echo $changwat_model->find()->where(['changwat_id' => $model->changwat_end])->one()['changwat_name']; ?>
            </td>
            <td style=" text-align: right;" valign="top"><?php echo number_format($model->income, 2); ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center; font-weight: bold;" colspan="2">
                รวมทั้งสิ้น
            </td>
            <td style=" text-align: right; font-weight: bold;" valign='bottom'>
                <?php echo number_format($model->income, 2); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" style=" text-align: right; font-weight: bold;">
                <b>( <?php echo $thaibaht->convert($model->income); ?> )</b>
            </td>
        </tr>
        <tr>
            <td colspan="3" style=" text-align: center; font-weight: bold;">จึงเรียนมาเพื่อทราบ</td>
        </tr>
        <tr>
            <td colspan="3" style=" text-align: center;">
                ในนาม <?php echo $company['companyname'] ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" style=" text-align: center; font-weight: bold;">
                <?php echo $company['ceo'] ?>
                <div id="line">.</div>
                AUTHORIZED SIGNATURE / DATE
            </td>
        </tr>
    </tfoot>
</table>

<!--
    ###################### END #########################
-->
