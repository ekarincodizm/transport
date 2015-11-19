<style type="text/css">
    body{color: #666666; font-size: 12px;}
    table tr td{ border-left: #000000 solid 1px; border-bottom: #000000 solid 1px; padding: 5px;}
    table tr th{ border-left: #000000 solid 1px; border-bottom: #000000 solid 1px;  border-top: #000000 solid 1px; padding: 5px; text-align: left; font-weight: bold;}
    table{ border-right: #000000 solid 1px;}
    table tr th p{ margin-bottom: 10px;}
    #line{ color: #FFF; font-size: 5px;}
</style>
<?php

use yii\helpers\Url;

$affiliated = new app\models\Affiliated;
$truck_model = new \app\models\AffiliatedTruck();
$config = new \app\models\Config_system();
//$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$producttype_model = new app\models\ProductType();
?>
<h3>
    สรุปรายรับ - รายจ่าย รหัสปฏิบัติงาน <?php echo $order_id; ?>
</h3>
<?php $employer = $customer_model->find()->where(['cus_id' => $model->employer])->one() ?>
<b>ผู้ว่าจ้าง :</b> <?php echo $employer['company']; ?>  <br/>
<b>ที่อยู่ : </b> <?php echo $employer['address']; ?>
<table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th style="text-align: center; font-weight: bold; width: 50%;">ทะเบียนรถ</th>
            <th style="text-align: center; font-weight: bold;">คนขับ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center; font-weight: bold;">
                ทะเบียนรถ <?php echo $truck_model->find()->where(['id' => $model->truck1])->one()['license_plate']; ?><br/>
                ทะเบียนรถ-พ่วง <?php echo $truck_model->find()->where(['id' => $model->truck2])->one()['license_plate']; ?>
            </td>
            <td style="text-align: center; font-weight: bold;">
                คนขับ 1 <?php echo $model->driver1; ?><br/>
                คนขับ 2 <?php echo $model->driver2; ?>
            </td>
        </tr>
    </tbody>
</table>

<b>รายรับ</b>
<table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th style="text-align: center; width: 5%;">#</th>
            <th>รายการ</th>
            <th style="text-align:center; width: 15%;">ราคา</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sumincome = 0;
        $i = 0;
        foreach ($assigns as $assign): $i++;
            $sumincome = $sumincome + $assign['income'];
            ?>
            <tr>
                <td style="text-align:center;" valign="top"><?php echo $i; ?></td>
                <td>
                    - ค่าขนส่ง <?php echo $producttype_model->find()->where(['id' => $assign['product_type']])->one()->product_type; ?>
                    <div id="line">.</div>
                    - ลุกค้า <?php echo $customer_model->find()->where(['cus_id' => $assign['cus_start']])->one()['company']; ?>
                    ปลายทาง <?php echo $customer_model->find()->where(['cus_id' => $assign['cus_end']])->one()['company']; ?>
                    <div id="line">.</div>
                    - เส้นทาง <?php echo $changwat_model->find()->where(['changwat_id' => $assign['changwat_start']])->one()['changwat_name']; ?>
                    - <?php echo $changwat_model->find()->where(['changwat_id' => $assign['changwat_end']])->one()['changwat_name']; ?>
                </td>
                <td style="text-align: right;" valign="top"> <?php echo number_format($assign['income'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align:center;"><b>รวม</b></td>
            <td style="text-align: right;"><b><?php echo number_format($sumincome, 2); ?></b></td>
        </tr>
    </tfoot>
</table>

<b>รายจ่าย</b>
<table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th style="text-align:center; width: 5%;">#</th>
            <th>รายการ</th>
            <th style="text-align:center; width: 15%;">ราคา</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style=" text-align: center;">1</td>
            <td>ค่าจ้างขน <?php echo $affiliated->find()->where(['company_id' => $model->company_id])->one()['company'];?></td>
            <td style=" text-align: right;"><?php echo number_format($model->price_affiliated, 2); ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align:center;"><b>รวม</b></td>
            <td style="text-align: right;"><b><?php echo number_format($model->price_affiliated, 2); ?></b></td>
        </tr>
    </tfoot>
</table>

<div style=" width: 100%;">
    <div style=" width: 45%;"><p></p></div>
    <div style=" width: 50%; float: right;">
        <table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
            <tr>
                <th style="text-align: center; font-weight: normal; font-size: 16px; width: 60%;">รายรับ</th>
                <th style="text-align: right; font-weight: normal; font-size: 16px;"><?php echo number_format($sumincome, 2); ?></th>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; font-size: 16px;">รายจ่าย</td>
                <td style="text-align: right; font-weight: normal; font-size: 16px;"><?php echo number_format($model->price_affiliated, 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; font-size: 16px;">สุทธิ</td>
                <td style="text-align: right; font-weight: bold; font-size: 16px;"><?php echo number_format($sumincome - $model->price_affiliated, 2) ?></td>
            </tr>
        </table>
    </div>
</div>