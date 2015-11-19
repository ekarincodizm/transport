<style type="text/css">
    body{color: #666666; font-size: 12px;}
    table tr td{ border-left: #000000 solid 1px; border-bottom: #000000 solid 1px; padding: 5px;}
    table tr th{ border-left: #000000 solid 1px; border-bottom: #000000 solid 1px; border-top: #000000 solid 1px; padding: 5px; text-align: left; font-weight: normal;}
    table{ border-right: #000000 solid 1px;}
    table tr th p{ margin-bottom: 10px;}
</style>
<?php

use yii\helpers\Url;

$truck_model = new \app\models\AffiliatedTruck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$producttype_model = new app\models\ProductType();
$affiliated_model = new app\models\Affiliated;
$affiliated = $affiliated_model->find()->where(['company_id' => $model->company_id])->one();
?>
<!--
    #ข้อมูลใบปฏิบัติงาน
    Comment By Kimniyom
-->

<div style="width:40%; position: fixed; right:0px; float: right; text-align: center; border: #000 solid 1px; padding-top: 2px;">
    <center>
        <img src="<?php echo Url::to('@web/web/images/logo.jpg', true) ?>" width="80px;"/><br/>
        <div style="width:100%;">
            <h3><?php echo "ห้างหุ้นส่วนจํากัด ตงตง ทรานสปอร์ต"; ?></h3>
        </div>
    </center>
</div>

<div class="row" style=" width: 50%;">
    <div style=" border: #000000 solid 1px; padding: 5px; margin-bottom: 10px;">
        <h3>บริษัทรถร่วม</h3>
        <label><?php echo $affiliated->company; ?></label><br/>
        <label>เลขทผู้เสียภาษี : <?php echo $affiliated['tax_number'] ?></label> <br/>
        <label>ที่อยู่ : <?php echo $affiliated['address'] ?></label> <br/>
        <label>ติดต่อ : <?php echo $affiliated['tel'] ?></label>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3">
        <h3>ใบบฏิบัติงาน
            <?php echo $model->order_id; ?>
        </h3>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3">
        <label>วันที่ไป</label> 
        <label class="label label-success">
            <?php echo $config->thaidate($model->order_date_start); ?>
        </label>
        <label>วันที่กลับ</label> 
        <label class="label label-success">
            <?php echo $config->thaidate($model->order_date_end); ?>
        </label>
    </div>

    <div class="col-sm-6 col-md-3 col-lg-3">
        <?php
        echo "<label>ทะเบียนรถ </label>";
        $rs = $truck_model->find()->where(['id' => $model->truck1])->one();
        echo '<label class="label label-success">' . $rs['license_plate'] . '</label>';
        ?>

        <?php
        echo " <label>ทะเบียนพ่วง </label>";
        $rs2 = $truck_model->find()->where(['id' => $model->truck2])->one();
        if (!empty($rs2)) {
            echo '<label class="label label-success">' . $rs2['license_plate'] . '</label>';
        } else {
            echo " -";
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-2 col-lg-3">
        <label>คนขับ 1</label> 
        <label class="label label-success"><?php echo $model->driver1; ?></label>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-3">
        <label>คนขับ 2</label> 
        <label class="label label-success"><?php echo $model->driver2; ?></label>
    </div>
</div>

<div style="float: right; text-align: right;">
    เลทที่ใบสั่งงาน <?php echo $assign->assign_id; ?>
</div>

<div class="well" style=" border: #000000 solid 1px; padding: 5px; border-bottom: none;">
    <b>วันที่ขน :</b>  <?php echo $config->thaidate($assign->transport_date); ?> <br/>
    <b>เส้นทาง : </b>
    <?php echo $changwat_model->find()->where(['changwat_id' => $assign->changwat_start])->one()->changwat_name; ?>
    -
    <?php echo $changwat_model->find()->where(['changwat_id' => $assign->changwat_end])->one()->changwat_name; ?><br/>
    <b>ลูกค้าต้นทาง : </b>
    <?php
    $cus_s = $customer_model->find()->where(['cus_id' => $assign->cus_start])->one();
    echo $cus_s->company;
    ?>
    <b>ที่อยู่ :</b> <?php echo $cus_s->address; ?><br/>
    <b>ลูกค้าปลายทาง : </b>
    <?php
    $cus_e = $customer_model->find()->where(['cus_id' => $assign->cus_end])->one();
    echo $cus_e->company;
    ?> 
    <b>ที่อยู่ : </b><?php echo $cus_e->address; ?>
</div>

<table class="table table-bordered" style="width:100%;" cellpadding="1" cellspacing="0" width="100%">
    <tr>
        <th>#</th>
        <th style="text-align:center;">รายการ</th>
        <th style="text-align:center;">น้ำหนัก(ตัน)</th>
    </tr>
    <tr>
        <td>1</td>
        <td>ขนส่ง <?php echo $producttype_model->find()->where(['id' => $assign->product_type])->one()->product_type; ?></td>
        <td style="text-align: center;"><?php echo $assign->weigh; ?></td>
    </tr>
</table>

<!--
    ###################### END #########################
-->

<!-- ผู้รับเงิน -->
<div style="position: absolute; bottom: 100px; left: 50px; width: 40%; border-bottom: #000000 dotted 1px;">

</div>

<div style="position: absolute; bottom: 50px; left: 50px; width: 40%; text-align: center;">
    <b>ผู้รับเงิน</b>
</div>

<!-- ผู้อนุมัติ -->
<div style="position: absolute; bottom: 100px; right: 50px; width: 40%; border-bottom: #000000 dotted 1px;">

</div>

<div style="position: absolute; bottom: 50px; right: 50px; width: 40%; text-align: center;">
    <b>ผู้อนุมัติ</b>
</div>