<style type="text/css">
    #set_page{ font-size: 12px; color: #0000ff;}
    .form-control{font-size: 12px; /*color: #0000ff;*/}
    .input-group-addon{font-size: 12px; color: #0000ff;}
</style>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$order_model = new \app\models\OrdersTransport();
?>

<script type="text/javascript">
    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.'))
            return false;
        //ele.onKeyPress = vchar;
    }
</script>

<div class="row" id="set_page">
    <div class="col-sm-12 col-md-12 col-lg-12">

        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-book"></i> ใบปฏิบัติงาน(รถภายใน)
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-box-tool" onclick="conclude()">สรุป(รับ - จ่าย)</i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <!--
                    #ข้อมูลใบปฏิบัติงาน
                    Comment By Kimniyom
                -->
                <div class="well" style="padding: 5px;">
                    <p>
                        <?= Html::a('<i class="fa fa-pencil"></i> แก้ไขใบปฏิบัติงาน', ['update', 'id' => $model->id], ['class' => 'btn btn-default btn-xs']) ?>
                    </p>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3"><label>ใบบฏิบัติงาน</label> <label class="label label-success"><?php echo $model->order_id; ?></label></div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <label>วันที่ไป</label> 
                            <label class="label label-success">
                                <?php echo $config->thaidate($model->order_date_start); ?>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <label>วันที่กลับ</label> 
                            <label class="label label-success">
                                <?php echo $config->thaidate($model->order_date_end); ?>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <?php
                            echo "<label>ทะเบียนรถ </label>";
                            $rs_truck = $truck_model->find()->where(['id' => $model->truck1])->one();
                            echo '<label class="label label-success">' . $rs_truck['license_plate'] . '</label>';
                            ?>

                            <?php
                            echo " <label>ทะเบียนพ่วง </label>";
                            $rs_truck2 = $truck_model->find()->where(['id' => $model->truck2])->one();
                            if (!empty($rs_truck2)) {
                                echo '<label class="label label-success">' . $rs_truck2['license_plate'] . '</label>';
                            } else {
                                echo " -";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-2 col-lg-3">
                            <label>คนขับ 1</label> 
                            <label class="label label-success">
                                <?php
                                $d1 = $driver->find()->where(['id' => $model->driver1])->one();
                                echo $d1['name'] . ' ' . $d1['lname'];
                                ?></label>
                            <input type="hidden" id="driver1" value="<?php echo $d1['driver_id'] ?>"/>
                        </div>
                        <div class="col-sm-6 col-md-2 col-lg-3">
                            <label>คนขับ 2</label> 
                            <label class="label label-success">
                                <?php
                                $d2 = $driver->find()->where(['id' => $model->driver2])->one();
                                if (!empty($d2)) {
                                    echo $d2['name'] . ' ' . $d2['lname'];
                                } else {
                                    echo "-";
                                }
                                ?>
                            </label>
                            <input type="hidden" id="driver2" value="<?php echo $d2['driver_id'] ?>"/>
                        </div>
                    </div>
                </div>
                <!--
                    ###################### END #########################
                -->
                <div class="panel panel-info">
                    <div class="panel-heading">รายละเอียดก่อนปล่อยรถ</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-tint"></i> น้ำมันที่กำหนด</div>
                                        <input type="text" id="oil_set" name="oil_set" class="form-control" value="<?php echo $model->oil_set ?>" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                        <div class="input-group-addon">ลิตร</div>
                                        <div class="input-group-addon btn btn-default" onclick="Save_before_release()"><i class="fa fa-save"></i> บันทึก</div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <!--
                    ######################### #ใบสั่งงาน ######################
                -->

                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-truck"></i> <i class="fa fa-angle-up"></i> รายละเอียดขาไป</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-truck"></i> <i class="fa fa-angle-down"></i> รายละเอียดขากลับ</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style="background: #FFF; border: #dedcdc solid 1px; border-top: 0px; padding: 5px;">
                        <!-- ฟอร์มกรอกขาไป -->
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="panel panel-info">
                                <div class="panel-heading">รายการใบสั่งงาน</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            วันที่ขน <?php
                                            echo DatePicker::widget([
                                                'id' => 'transport_date',
                                                'name' => 'transport_date',
                                                //'model' => $model,
                                                //'attribute' => 'driver_license_expire',
                                                'language' => 'th',
                                                'value' => date("Y-m-d"),
                                                'removeButton' => false,
                                                'readonly' => true,
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'format' => 'yyyy-mm-dd'
                                                ]
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            ลูกค้า
                                            <select id="cus_start" class="form-control">
                                                <option value="">== เลือกลูกค้า ==</option>
                                                <?php
                                                $customer = \app\models\Customer::find()->all();
                                                foreach ($customer as $cus):
                                                    ?>
                                                    <option value="<?php echo $cus->cus_id ?>"><?php echo $cus->cus_id . '-' . $cus->company; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            ใบสั่งงาน 
                                            <input type="text" id="assign_id" name="assign_id" class="form-control" readonly="readonly" value="<?php echo $assign_id; ?>"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            ต้นทาง
                                            <select id="changwat_start" class="form-control">
                                                <option value="">== ต้นทาง ==</option>
                                                <?php
                                                $changwat = \app\models\Changwat::find()->all();
                                                foreach ($changwat as $ch1):
                                                    ?>
                                                    <option value="<?php echo $ch1->changwat_id; ?>"><?php echo $ch1->changwat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            ปลายทาง
                                            <select id="changwat_end" class="form-control">
                                                <option value="">== ปลายทาง ==</option>
                                                <?php
                                                foreach ($changwat as $ch2):
                                                    ?>
                                                    <option value="<?php echo $ch2->changwat_id; ?>"><?php echo $ch2->changwat_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            ลูกค้าปลายทาง
                                            <select id="cus_end" class="form-control">
                                                <option value="">== เลือกลูกค้า ==</option>
                                                <?php
                                                $customer_end = \app\models\Customer::find()->all();
                                                foreach ($customer_end as $cusend):
                                                    ?>
                                                    <option value="<?php echo $cusend->cus_id; ?>"><?php echo $cusend->cus_id . '-' . $cusend->company; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            ประเภทสินค้า
                                            <select id="product_type" class="form-control">
                                                <option value=""> == ประเภทสินค้า ==</option>
                                                <?php
                                                $product_type = \app\models\ProductType::find()->all();
                                                foreach ($product_type as $Ptype):
                                                    ?>
                                                    <option value="<?php echo $Ptype['id'] ?>"><?php echo $Ptype->product_type; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="jumbotron" style="padding: 5px; margin-top: 10px; margin-bottom: 5px;">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-balance-scale"></i> น้ำหนัก</div>
                                                <input type="text" id="weigh" name="weigh" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                                <div class="input-group-addon">ตัน</div>
                                            </div>
                                        </div> 

                                        <input type="hidden" id="type_calculus"/>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-1 col-lg-1">
                                                <label>คิดตาม</label>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><input type="radio" name="r1" id="r1" onclick="Unit_price_Calculator()"/> น้ำหนัก ตันละ </div>
                                                        <input type="text" id="unit_price" name="unit_price" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" onkeyup="Income_Calculator(0);" disabled="disabled"/>
                                                        <div class="input-group-addon">บาท</div>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="col-sm-6 col-md-5 col-lg-5"> 
                                                <div class="input-group">
                                                    <div class="input-group-addon"><input type="radio" name="r1" id="r2" onclick="Pertimes_Calculator()"/> ต่อเที่ยว เที่ยวละ</div>
                                                    <input type="text" id="per_times" name="per_times" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" disabled="disabled" onkeyup="Income_Calculator(1);"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="jumbotron" style="padding: 5px; margin-top: 0px; margin-bottom: 5px;">
                                        <label>เบี้ยเลี้ยง</label>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">เบี้ยเลี้ยงคนขับ(1)</div>
                                                        <input type="text" id="allowance_driver1" name="allowance_driver1" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                                        <div class="input-group-addon">บาท</div>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6"> 
                                                <div class="input-group">
                                                    <div class="input-group-addon">เบี้ยเลี้ยงคนขับ(2)</div>
                                                    <?php if (!empty($model->driver2)) { ?>
                                                        <input type="text" id="allowance_driver2" name="allowance_driver2" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                                    <?php } else { ?>
                                                        <input type="text" id="allowance_driver2" name="allowance_driver2" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" readonly="readonly"/>
                                                    <?php } ?>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-money"></i> รายได้</div>
                                                <input type="hidden" id="income"/>
                                                <input type="text" id="income_txt" name="income_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" readonly="readonly" value="0"/>
                                                <div class="input-group-addon">บาท</div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>

                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <a href="<?php echo Url::to(['reportall', "id" => $model->id]) ?>" target="_blank">
                                            <button type="button" class="btn btn-default" style=" border-radius: 0px;"><i class="fa fa-print"></i> พิมพ์ใบสั่งงานทั้งหมด</button></a>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>วันที่ขน</th>
                                                    <th>ลูกค้า</th>
                                                    <th>เส้นทาง</th>
                                                    <th>ลูกค้าปลายทาง</th>
                                                    <th>เลขที่ใบขน</th>
                                                    <th>เบี้ยเลี้ยง</th>
                                                    <th>รายได้</th>
                                                    <th style="text-align: center;">ตัวเลือก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $sum = array(0, 0);
                                                foreach ($assign as $rs): $i++;
                                                    $allowance_driver1 = substr($rs->allowance_driver1, 6, 8);
                                                    $allowance_driver2 = substr($rs->allowance_driver2, 6, 8);
                                                    $allowance = ((int) $allowance_driver1 + (int) $allowance_driver2);
                                                    $sum[0] = $sum[0] + $allowance;
                                                    $sum[1] = $sum[1] + $rs->income;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $config->thaidate($rs->transport_date); ?></td>
                                                        <td><?php echo $customer_model->find()->where(['cus_id' => $rs->cus_start])->one()->company; ?></td>
                                                        <td>
                                                            <?php echo $changwat_model->find()->where(['changwat_id' => $rs->changwat_start])->one()->changwat_name; ?>
                                                            -
                                                            <?php echo $changwat_model->find()->where(['changwat_id' => $rs->changwat_end])->one()->changwat_name; ?>
                                                        </td>
                                                        <td><?php echo $customer_model->find()->where(['cus_id' => $rs->cus_end])->one()->company; ?></td>
                                                        <td><?php echo $rs->assign_id; ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($allowance, 2); ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($rs->income, 2); ?></td>
                                                        <td style="text-align: center;">
                                                            <a href="<?php echo Url::to(['report', "id" => $model->id, "assign_id" => $rs->assign_id]) ?>" target="_blank">
                                                                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></a>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="delete_assign('<?php echo $rs->id ?>')"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" style="text-align: center;">
                                                        รวม
                                                    </td>
                                                    <td style="text-align: right; color: #ff0000; font-weight: bold;"><?php echo number_format($sum[0], 2); ?></td>
                                                    <td style="text-align: right; color: #ff0000; font-weight: bold;"><?php echo number_format($sum[1], 2); ?></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- END Well -->
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-success btn-block btn-lg" onclick="save_assign()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                                </div>
                            </div>
                            <hr/>

                            <!-- 
                            #### END panel-success ####
                            -->

                            <div class="panel panel-primary">
                                <div class="panel-heading">ค่าเชื้อเพลิง/ระยะทาง</div>
                                <div class="panel-body">
                                    <div class="well well-sm">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                น้ำมันเติม *
                                                <div class="input-group">
                                                    <input type="text" id="oil" name="oil" class="form-control" onkeyup="oil_calculus()" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" value="<?php echo $model->oil; ?>"/>
                                                    <div class="input-group-addon">ลิตร</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                ลิตรละ *
                                                <div class="input-group">
                                                    <input type="text" id="oil_unit" name="oil_unit" class="form-control" onkeyup="oil_calculus()" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" value="<?php echo $model->oil_unit; ?>"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                รวม
                                                <div class="input-group">
                                                    <input type="hidden" id="oil_price" value="<?php echo $model->oil_price; ?>"/>
                                                    <input type="text" id="oil_price_txt" name="oil_price_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" readonly="readonly" value="<?php echo number_format($model->oil_price, 2); ?>"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                แก๊สเติม
                                                <div class="input-group">
                                                    <input type="text" id="gas" name="gas" class="form-control" onkeyup="gas_calculus()" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" value="<?php echo $model->gas; ?>"/>
                                                    <div class="input-group-addon">กก.</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                กก.ละ
                                                <div class="input-group">
                                                    <input type="text" id="gas_unit" name="gas_unit" class="form-control" onkeyup="gas_calculus()" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" value="<?php echo $model->gas_unit; ?>"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                รวม
                                                <div class="input-group">
                                                    <input type="hidden" id="gas_price" value="<?php echo $model->gas_price; ?>"/>
                                                    <input type="text" id="gas_price_txt" name="gas_price_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" readonly="readonly" value="<?php echo number_format($model->gas_price, 2); ?>"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>

                                        <br/>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">เลขไมล์เดิม</div>
                                                        <?php $old_mile = $order_model->get_old_mile($model->order_id); ?>
                                                        <input type="text" id="old_mile" name="old_mile" class="form-control" readonly="readonly" value="<?php echo $old_mile; ?>"/>
                                                        <div class="input-group-addon">บาท</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">เลขไมล์เที่ยวนี้ *</div>
                                                        <input type="text" id="now_mile" name="now_mile" class="form-control" value="<?php echo $model->now_mile; ?>" placeholder="... ตัวเลขเท่านั้น"
                                                               onkeypress="return chkNumber()" onkeyup="distance_calculus()"/>
                                                        <div class="input-group-addon">บาท</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">ระยะทางเที่ยวนี้</div>
                                                        <input type="text" id="distance" name="distance" class="form-control" readonly="readonly" value="<?php echo $model->distance; ?>"/>
                                                        <div class="input-group-addon">ก.ม.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">น้ำมันที่กำหนด</div>
                                                        <input type="text" id="oil_set_ofter" name="oil_set_ofter" class="form-control" value="<?php echo $model->oil_set ?>" readonly="readonly" style="text-align: center; color: #ff0033;"/>
                                                        <div class="input-group-addon">ลิตร</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">เฉลี่ย</div>
                                                        <input type="text" id="avg_oil" name="avg_oil" class="form-control" readonly="readonly" value="<?php echo $model->avg_oil; ?>"/>
                                                        <div class="input-group-addon">ก.ม./ลิตร</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">ชดเชยน้ำมัน</div>
                                                        <input type="text" id="compensate" name="compensate" class="form-control" readonly="readonly" value="<?php echo $model->compensate; ?>"/>
                                                        <div class="input-group-addon">ลิตร</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-success" onclick="save_fuel()"><i class="fa fa-save"></i> บันทึกเติมน้ำมัน</button>
                                    <span id="process_fuel_success" style="display: none;"><i class="fa fa-check text-green"></i> บันทึกข้อมูลแล้ว ...</span>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            ค่าใช้จ่ายอื่น ๆ
                                            <div class="pull-right">
                                                <i class="fa fa-refresh fa-spin" id="l-ding" style="display:none;"></i>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">รายการ</div>
                                                            <input type="text" id="detail" name="detail" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-9 col-lg-9">  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">จำนวนเงิน</div>
                                                            <input type="text" id="price" name="price" class="form-control" onkeypress="return chkNumber()"/>
                                                            <div class="input-group-addon">บาท</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: center;">
                                                    <button type="button" class="btn btn-success btn-block"
                                                            onclick="save_outgoings()"><i class="fa fa-save"></i> บันทึก</button>
                                                </div>
                                            </div>

                                            <br/>

                                            <!-- แสดงข้อมูลรายจ่าย อื่น ๆ -->
                                            <div id="tb_outgoings">
                                                <!-- Loading (remove the following to stop the loading)-->

                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <i class="fa fa-cogs"></i> ค่าใช้จ่ายเกี่ยวกับรถ
                                            <div class="pull-right">
                                                <i class="fa fa-refresh fa-spin" id="e-ding" style="display:none;"></i>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">ทะเบียนรถ</div>
                                                            <select id="truck_license" class="form-control" style="border-radius: 0px;">
                                                                <option value="<?php echo $rs_truck['license_plate']; ?>"><?php echo $rs_truck['license_plate']; ?></option>
                                                                <?php if (!empty($rs_truck2)) { ?>
                                                                    <option value="<?php echo $rs_truck2['license_plate']; ?>"><?php echo $rs_truck2['license_plate']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">รายการ</div>
                                                            <input type="text" id="truck_detail" name="truck_detail" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-9 col-lg-9">  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">จำนวนเงิน</div>
                                                            <input type="text" id="truck_price" name="truck_price" class="form-control" onkeypress="return chkNumber()"/>
                                                            <div class="input-group-addon">บาท</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: center;">
                                                    <button type="button" class="btn btn-success btn-block"
                                                            onclick="save_expenses()"><i class="fa fa-save"></i> บันทึก</button>
                                                </div>
                                            </div>

                                            <br/>

                                            <!-- แสดงข้อมูลรายจ่าย เกี่ยวกับตัวรถ -->
                                            <div id="tb_expenses">
                                                <!-- Loading (remove the following to stop the loading)-->

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <hr/>
                            <div class="panel panel-danger">
                                <div class="panel-heading">ข้อความ</div>
                                <div class="panel-body">
                                    <textarea class="form-control" rows="5" id="message"><?php echo $model->message; ?></textarea>
                                </div>
                            </div>
                            <div id="process_success" style=" display: none;"><i class="fa fa-check fa-2x text-green"></i> บันทึกข้อมูลแล้ว ...</div>
                            <button type="button" class="btn btn-primary" onclick="save_message();"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                            <a href="<?php echo Yii::$app->getHomeUrl(); ?>">
                                <button type="button" class="btn btn-danger"><i class="fa fa-sign-out"></i> ออกจากหน้านี้</button></a>
                        </div>
                        <!-- ฟอร์มกรอกขากลับ -->
                        <div role="tabpanel" class="tab-pane" id="profile">2</div>
                    </div>

                </div>
            </div>
        </div>
    </div> <!--- END CONTENT -->

</div><!-- End Row -->



<div class="modal fade" id="conclude">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: #e6eff2;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">สรุป (รับ - จ่าย)</h4>
            </div>
            <div class="modal-body">
                <!--- สรุป รับ - จ่าย -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-plus-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">รายได้</span>
                                <span class="info-box-number" id="income_all"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-minus-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">รายจ่าย</span>
                                <span class="info-box-number" id="expenses_all"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red">
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">คงเหลือ</span>
                                <span class="info-box-number" id="total"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- SET TEXT BOX VALUE HIDDEN -->
<input type="hidden" id="order_id" value="<?php echo $model->order_id; ?>"/>
<input type="hidden" id="Url_save_before_release" value="<?php echo Url::to(['save_before_release']) ?>"/>
<input type="hidden" id="Url_save_assign" value="<?php echo Url::to(['save_assign']) ?>"/>
<input type="hidden" id="Url_save_fuel" value="<?php echo Url::to(['save_fuel']) ?>"/>
<input type="hidden" id="Url_outgoings" value="<?php echo Url::to(['outgoings/load_data']) ?>"/>
<input type="hidden" id="Url_save_outgoings" value="<?php echo Url::to(['outgoings/save']) ?>"/>
<input type="hidden" id="Url_expenses" value="<?php echo Url::to(['expenses-truck/load_data']) ?>"/>
<input type="hidden" id="Url_save_expenses" value="<?php echo Url::to(['expenses-truck/save']) ?>"/>
<input type="hidden" id="Url_save_message" value="<?php echo Url::to(['save_message']) ?>"/>


<!-- รายรับ - รายจ่าย เที่ยวนี้ -->
<script type="text/javascript">
    function conclude() {
        var income = parseInt(<?php echo $sum[1] ?>);//รายรับ

        var allowance = parseInt(<?php echo $sum[0] ?>);//เบี้ยเลี้ยง
        var oil = parseInt($("#oil_price").val());//ค่าน้ำมัน
        var gas = parseInt($("#gas_price").val());//ค่าก๊าซ

        var expenses = parseInt($("#expenese_total").val());
        var expenses_truck = parseInt($("#expenese_truck_total").val());

        var expenses_total = (allowance + oil + gas + expenses + expenses_truck);
        var profit = (parseInt(income) - parseInt(expenses_total));
        $("#income_all").text(accounting.formatNumber(income, 2));
        $("#expenses_all").text(accounting.formatNumber(expenses_total, 2));
        $("#total").text(accounting.formatNumber(profit, 2));

        $("#conclude").modal();
    }

    function delete_assign(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        if (r == true) {
            var url = "<?php echo Url::to(['order-transport/delete_assign']) ?>";
            var data = {id: id};

            $.post(url, data, function (success) {
                window.location.reload();
                return false;
            });
        }
    }
</script>

