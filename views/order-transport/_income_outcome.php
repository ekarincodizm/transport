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

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$producttype_model = new app\models\ProductType();
$car_model = new \app\models\MapTruck();
$car = $car_model->find()->where(['car_id' => $model->car_id])->one();
?>
<h3>
    สรุปรายรับ - รายจ่าย รหัสสั่งงาน <?php echo $model->assign_id; ?>
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
                ทะเบียนรถ <?php echo $car['truck_1']; ?><br/>
                ทะเบียนรถ-พ่วง <?php echo $car['truck_2']; ?>
            </td>
            <td style="text-align: center; font-weight: bold;">
                <?php
                $d1 = $driver->find()->where(['driver_id' => $model->driver1])->one();
                $d2 = $driver->find()->where(['driver_id' => $model->driver2])->one();
                ?>
                คนขับ 1 <?php echo $d1['name'] . ' ' . $d1['lname']; ?><br/>
                คนขับ 2 <?php echo $d2['name'] . ' ' . $d2['lname']; ?>
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

            <tr>
                <td style="text-align:center;" valign="top">1</td>
                <td>
                    - ค่าขนส่ง <?php echo $producttype_model->find()->where(['id' => $model->product_type])->one()->product_type; ?>
                    <div id="line">.</div>
                    - ขึ้นของ <?php echo $customer_model->find()->where(['cus_id' =>$model->cus_start])->one()['company']; ?>
                    ลงของ <?php echo $customer_model->find()->where(['cus_id' => $model->cus_end])->one()['company']; ?>
                    <div id="line">.</div>
                    - เส้นทาง <?php echo $changwat_model->find()->where(['changwat_id' => $model->changwat_start])->one()['changwat_name']; ?>
                    - <?php echo $changwat_model->find()->where(['changwat_id' => $model->changwat_end])->one()['changwat_name']; ?>
                </td>
                <td style="text-align: right;" valign="top"> <?php echo number_format($model->income, 2); ?></td>
            </tr>

    </tbody>
    <tfoot>
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align:center;"><b>รวม</b></td>
            <td style="text-align: right;"><b><?php echo number_format($model->income, 2); ?></b></td>
        </tr>
    </tfoot>
</table>

<b>รายจ่าย</b>
<table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th>รายการ</th>
            <th style="text-align:center; width: 15%;">ราคา</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style=" text-align: center;">1</td>
            <td>น้ำมัน</td>
            <td style=" text-align: right;"><?php echo number_format($model->oil_price, 2); ?></td>
        </tr>
        <tr>
            <td style=" text-align: center;">2</td>
            <td>แก๊ส</td>
            <td style=" text-align: right;"><?php echo number_format($model->gas_price, 2); ?></td>
        </tr>
        <?php
        $sum_outgoing = 0;
        $j = 2;
        foreach ($outgoings as $outgoing): $j++;
            $sum_outgoing = $sum_outgoing + $outgoing['price'];
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;" valign="top"><?php echo $j; ?></td>
                <td><?php echo $outgoing['detail'] ?></td>
                <td style="text-align: right;" valign="top"> <?php echo number_format($outgoing['price'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php
        $sum_expense_truck = 0;
        $a = $j;
        foreach ($expenses as $expense): $a++;
            $sum_expense_truck = $sum_expense_truck + $expense['price'];
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;" valign="top"><?php echo $a; ?></td>
                <td><?php echo $expense['detail'] ?> ทะเบียนรถ <?php echo $expense['truck_license'] ?> </td>
                <td style="text-align: right;"> <?php echo number_format($expense['price'], 2); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php
        $sumallowance = 0;
            $allowance_1 = trim(substr($model->allowance_driver1, 6, 10));
            $allowance_2 = trim(substr($model->allowance_driver2, 6, 10));
            if (!empty($allowance_2)) {
                $sumallowance = ($allowance_1 + $allowance_2);
            } else {
                $sumallowance = $allowance_1;
            }
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;" valign="top"><?php echo $a + 1; ?></td>
                <td>
                    - เบี้ยเลี้ยง 1 
                    <?php
                    $driver1 = $driver->find()->where(['driver_id' => substr($model->allowance_driver1, 0, 5)])->one();
                    echo $driver1['name'] . ' ' . $driver1['lname'];
                    echo " " . $allowance_1 . " .-";
                    ?>

                    <div id="line"></div>
                    - เบี้ยเลี้ยง 2 
                    <?php
                    $driver2 = $driver->find()->where(['driver_id' => substr($model->allowance_driver2, 0, 5)])->one();
                    echo $driver2['name'] . ' ' . $driver2['lname'];
                    if ($allowance_2 != '') {
                        echo " " . $allowance_2 . " .-";
                    } else {
                        echo " -";
                    }
                    ?>

                </td>
                <td style=" text-align: right;" valign="top"><?php echo number_format((int)$sumallowance, 2) ?></td>
            </tr>

    </tbody>
    <tfoot>
        <?php $sum_expense_all = ($sum_outgoing + $sum_expense_truck + $model->oil_price + $model->gas_price); ?>
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align:center;"><b>รวม</b></td>
            <td style="text-align: right;"><b><?php echo number_format($sum_expense_all, 2); ?></b></td>
        </tr>
    </tfoot>
</table>

<div style=" width: 100%;">
    <div style=" width: 45%;"><p></p></div>
    <div style=" width: 50%; float: right;">
        <table class="table table-bordered" style="width: 100%;" cellpadding="1" cellspacing="0">
            <tr>
                <th style="text-align: center; font-weight: normal; font-size: 16px; width: 60%;">รายรับ</th>
                <th style="text-align: right; font-weight: normal; font-size: 16px;"><?php echo number_format($model->income, 2); ?></th>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; font-size: 16px;">รายจ่าย</td>
                <td style="text-align: right; font-weight: normal; font-size: 16px;"><?php echo number_format($sum_expense_all, 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; font-size: 16px;">สุทธิ</td>
                <td style="text-align: right; font-weight: bold; font-size: 16px;"><?php echo number_format($model->income - $sum_expense_all, 2) ?></td>
            </tr>
        </table>
    </div>
</div>