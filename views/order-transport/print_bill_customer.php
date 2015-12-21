<style type="text/css">
    body{color: #666666; font-size: 12px;}
    table tr td{ border-left: #000000 solid 1px; border-bottom: #000000 solid 1px; padding: 5px;}
    table tr th{ border-left: #000000 solid 1px; border-bottom: #000000 solid 1px; border-top: #000000 solid 1px; padding: 5px; text-align: left; font-weight: normal;}
    table{ border-right: #000000 solid 1px;}
    table tr th p{ margin-bottom: 10px;}
</style>
<?php

use yii\helpers\Url;

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$producttype_model = new app\models\ProductType();
$company_model = new app\models\Company();
$account_model = new \app\models\Account();
$company = $company_model->find()->one();
$account = $account_model->find()->where(['status' => 1])->one();
?>
<!--
    #ข้อมูลใบปฏิบัติงาน
    Comment By Kimniyom
-->
<div style=" position: absolute; left: 50px; top: 30px;">
    <div style="width: 80px;">
        <img src="<?php echo Url::to('@web/web/uploads/logo/'.$company['logo'], true) ?>"/>
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
    <p>ใบวางบิล [Statement]</p>
    <p>ลูกค้า [Customer]</p><br/>
    <div style=" width: 100%; border: #000000 solid 1px; padding: 5px;">
        <?php echo $account['bank_name']?><br/>
        บัญชีเลขที่ <?php echo $account['account_number']?><br/>
        <?php echo $account['account_name']?>
    </div>
</div>

<br/>


ลูกค้า : <?php echo $employer['company'] ?><br/>
ที่อยู่ : <?php echo $employer['address'] ?><br/>
โทร : <?php echo $employer['tel'] ?><br/>

<?php foreach ($assigns as $assign): ?>
    <div style="float: right; text-align: right;">
        เลทที่ใบสั่งงาน <?php echo $assign['assign_id']; ?>
    </div>

    <div class="well" style=" border: #000000 solid 1px; padding: 5px; border-bottom: none;">
        <b>วันที่ขน :</b>  <?php echo $config->thaidate($assign['transport_date']); ?> <br/>
        <b>เส้นทาง : </b>
        <?php echo $changwat_model->find()->where(['changwat_id' => $assign['changwat_start']])->one()->changwat_name; ?>
        -
        <?php echo $changwat_model->find()->where(['changwat_id' => $assign['changwat_end']])->one()->changwat_name; ?>
        <b>ต้นทาง : </b>
        <?php
        $cus_s = $customer_model->find()->where(['cus_id' => $assign['cus_start']])->one();
        echo $cus_s->company;
        ?>

        <b>ปลายทาง : </b>
        <?php
        $cus_e = $customer_model->find()->where(['cus_id' => $assign['cus_end']])->one();
        echo $cus_e->company;
        ?> 

    </div>

    <table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
        <tr>
            <th>#</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">น้ำหนัก(ตัน)</th>
            <th style="text-align:center;">ราคา</th>
        </tr>
        <tr>
            <td>1</td>
            <td>ค่าขนส่ง <?php echo $producttype_model->find()->where(['id' => $assign['product_type']])->one()->product_type; ?></td>
            <td style="text-align: center;"><?php echo $assign['weigh']; ?></td>
            <td style="text-align: right;"> <?php echo number_format($assign['income'], 2); ?></td>
        </tr>
        <tr style="font-weight: bold;">
            <td colspan="3" style="text-align:center;"><b>รวม</b></td>
            <td style="text-align: right;"><b><?php echo number_format($assign['income'], 2); ?></b></td>
        </tr>

    </table>
    <br/>
<?php endforeach; ?>



<!-- จ้างรถวิ่ง -->
<?php foreach ($assigns2 as $assign2): ?>
    <div style="float: right; text-align: right;">
        เลทที่ใบสั่งงาน <?php echo $assign2['order_id']; ?>
    </div>

    <div class="well" style=" border: #000000 solid 1px; padding: 5px; border-bottom: none;">
        <b>วันที่ขน :</b>  <?php echo $config->thaidate($assign2['transport_date']); ?> <br/>
        <b>เส้นทาง : </b>
        <?php echo $changwat_model->find()->where(['changwat_id' => $assign2['changwat_start']])->one()->changwat_name; ?>
        -
        <?php echo $changwat_model->find()->where(['changwat_id' => $assign2['changwat_end']])->one()->changwat_name; ?>
        <b>ต้นทาง : </b>
        <?php
        $cus_s = $customer_model->find()->where(['cus_id' => $assign2['cus_start']])->one();
        echo $cus_s->company;
        ?>

        <b>ปลายทาง : </b>
        <?php
        $cus_e = $customer_model->find()->where(['cus_id' => $assign2['cus_end']])->one();
        echo $cus_e->company;
        ?> 

    </div>

    <table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
        <tr>
            <th>#</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">น้ำหนัก(ตัน)</th>
            <th style="text-align:center;">ราคา</th>
        </tr>
        <tr>
            <td>1</td>
            <td>ค่าขนส่ง <?php echo $producttype_model->find()->where(['id' => $assign2['product_type']])->one()->product_type; ?></td>
            <td style="text-align: center;"><?php echo $assign2['weigh']; ?></td>
            <td style="text-align: right;"> <?php echo number_format($assign2['income'], 2); ?></td>
        </tr>
        <tr style="font-weight: bold;">
            <td colspan="3" style="text-align:center;"><b>รวม</b></td>
            <td style="text-align: right;"><b><?php echo number_format($assign2['income'], 2); ?></b></td>
        </tr>

    </table>
    <br/>
<?php endforeach; ?>
<!--
    ###################### END #########################
-->

<div style="position:relative; width: 100%; margin-top: 80px;">
    <!-- ผู้รับเงิน -->
    <div style="position: absolute; bottom: 100px; left: 0px; width: 40%; border-bottom: #000000 dotted 1px; float: left;"></div>
    <!-- ผู้อนุมัติ -->
    <div style="position: absolute; bottom: 100px; right: 0px; width: 40%; border-bottom: #000000 dotted 1px; float: right;"></div>

    <div style="position: absolute; bottom: 50px; left: 0px; width: 40%; text-align: center; float: left; margin-top: 10px;">
        <b>ผู้รับเงิน</b>
    </div>
    <div style="position: absolute; bottom: 50px; right: 0px; width: 40%; text-align: center; float: right; margin-top: 0px;">
        <b>ผู้อนุมัติ</b>
    </div>

</div>