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
        <b>ลูกค้า :</b> <?php echo $employer['company']; ?>  <br/>
        <b>ที่อยู่ : </b> <?php echo $employer['address']; ?><br/>
        <b>Tel : </b> <?php echo $employer['tel']; ?>
    </div>
    <div style="width:49%; float: right; border-left: #000000 solid 1px;">
        <div style=" text-align: left; float: left; width: 50%; border-right: #000 solid 1px; padding-left: 5px;">
            <b>เลขที่ Invoice No.:</b><br/>
            <b>วันที่ Invoice Date :</b>
        </div>
        <div style=" text-align: center; float: left; width: 46%;">
            <?php
            $year = substr(date('Y'), 2, 2);
            $month = date("m");
            $day = date("d");
            $time = date("s");
            echo date("Y-m-d H:i:s");
            ?><br/>
            <?php echo $config->thaidate(date("Y-m-d")); ?>
        </div>
        <div style="text-align: left; width: 100%; border-top: #000 solid 1px; padding: 5px;">
            <?php echo $account['bank_name'] ?>
            สาขา <?php echo $account['brance'] ?><br/> 
            บัญชีเลขที่ <?php echo $account['account_number'] ?><br/>
            <?php echo $account['account_name'] ?>
        </div>
    </div>
</div>

<table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">เที่ยววันที่</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">น้ำหนัก(ตัน)</th>
            <th style="text-align:center;">ราคา</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        $i = 0;
        foreach ($assigns as $assign): $i++;
            $total = $total + $assign['income'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $config->thaidate($assign['transport_date']); ?></td>
                <td>
                    ค่าขนส่ง <?php echo $producttype_model->find()->where(['id' => $assign['product_type']])->one()->product_type; ?>
                    ใบสั่งงาน <?php echo $assign['assign_id']; ?>
                    <?php echo $changwat_model->find()->where(['changwat_id' => $assign['changwat_start']])->one()->changwat_name; ?>
                    -
                    <?php echo $changwat_model->find()->where(['changwat_id' => $assign['changwat_end']])->one()->changwat_name; ?>
                    <br/>
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
                </td>
                <td style="text-align: center;"><?php echo $assign['weigh']; ?></td>
                <td style="text-align: right;"> <?php echo number_format($assign['income'], 2); ?></td>
            </tr>
        <?php endforeach; ?>

        <!-- จ้างรถวิ่ง -->
        <?php
        $out_assign = 0;
        $a = $i;
        foreach ($assigns2 as $assign2): $a++;
            $out_assign = $out_assign + $assign2['income'];
            ?>

            <tr>
                <td><?php echo $a; ?></td>
                <td><?php echo $config->thaidate($assign2['transport_date']); ?></td>
                <td>
                    ค่าขนส่ง <?php echo $producttype_model->find()->where(['id' => $assign2['product_type']])->one()->product_type; ?>
                    <b>ใบสั่งงาน</b>  <?php echo $assign2['order_id']; ?> 
                    <?php echo $changwat_model->find()->where(['changwat_id' => $assign2['changwat_start']])->one()->changwat_name; ?>
                    -
                    <?php echo $changwat_model->find()->where(['changwat_id' => $assign2['changwat_end']])->one()->changwat_name; ?>
                    <br/>
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
                </td>
                <td style="text-align: center;"><?php echo $assign2['weigh']; ?></td>
                <td style="text-align: right;"> <?php echo number_format($assign2['income'], 2); ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
    <tfoot>
        <tr>
            <td style=" text-align: center; font-weight: bold;" colspan="4">
                รวมทั้งสิ้น
            </td>
            <td style=" text-align: right; font-weight: bold; color:red;" valign='bottom'>
                <?php echo number_format(($total + $out_assign), 2); ?>
            </td>
        </tr>
        <tr>
            <td colspan="5" style=" text-align: right; font-weight: bold; color:red;">
                <b>( <?php echo $thaibaht->convert(($total + $out_assign)); ?> )</b>
            </td>
        </tr>
        <tr>
            <td colspan="5" style=" text-align: center; font-weight: bold;">จึงเรียนมาเพื่อทราบ</td>
        </tr>
        <tr>
            <td colspan="5" style=" text-align: center;">
                ในนาม <?php echo $company['companyname'] ?>
            </td>
        </tr>
        <tr>
            <td colspan="5" style=" text-align: center; font-weight: bold;">
                <?php echo $company['ceo'] ?>
                <div id="line">.</div>
                AUTHORIZED SIGNATURE / DATE
            </td>
        </tr>
    </tfoot>

</table>
<br/>


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