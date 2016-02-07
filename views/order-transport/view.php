<style type="text/css">
    #set_page{ font-size: 12px; color: #0000ff;}
    .form-control{font-size: 12px; /*color: #0000ff;*/}
    .input-group-addon{font-size: 12px; color: #0000ff;}
</style>
<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = $model->assign_id;
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่งงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$order_model = new \app\models\OrdersTransport();

$car_model = new \app\models\MapTruck();
$car_view = $car_model->findOne(['car_id' => $model->car_id]);
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
                <i class="fa fa-book"></i> ใบสั่งงาน(รถภายใน)
                <div class="box-tools pull-right">
                    <?php if ($model->flag == 0) { ?>
                        <a href="<?php echo Url::to(['bill', 'id' => $model->id]) ?>" target="_bank">
                            <button type="button" class="btn btn-default btn-box-tool"><i class="fa fa-newspaper-o"></i> ออกบิลใบแจ้งหนี้</button></a>
                        <a href="javascript:confirm_order('<?php echo $model->id; ?>')">
                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-check"></i> ยืนยันการโอนเงิน</button></a>
                    <?php } else { ?>
                        <a href="<?php echo Url::to(['receipt', 'id' => $model->id]) ?>" target="_bank">
                            <button type="button" class="btn btn-default btn-box-tool"><i class="fa fa-file-text-o"></i> ออกใบเสร็จ</button></a>
                    <?php } ?>
                    <a href="<?php echo Url::to(['incom_outcome', 'id' => $model->id]) ?>" target="_bank">
                        <button type="button" class="btn btn-default btn-box-tool"><i class="fa fa-file-text-o"></i> รายละเอียด(รับ - จ่าย)</button></a>
                </div>
            </div>
            <div class="box-body" style=" padding: 2px;">
                <!--
                    #ข้อมูลใบปฏิบัติงาน
                    Comment By Kimniyom
                -->

                <!--
                #ข้อมูลใบปฏิบัติงาน
                Comment By Kimniyom
                -->
                <div class="box box-default  collapsed-box" style="padding: 5px;">
                    <div class="box-header with-border">
                        รายละเอียดใบงาน
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body" style=" padding: 2px;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-book"></i> ใบสั่งงานเลขที่</div>
                                        <input type="text" class="form-control" value="<?php echo $model->assign_id; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-building-o"></i> ผู้ว่าจ้าง</div>
                                        <select id="employer" class="form-control" disabled="disabled">
                                            <option value="">== เลือกผู้ว่าจ้าง ==</option>
                                            <?php
                                            $employer = \app\models\Customer::find()->all();
                                            foreach ($employer as $employers):
                                                ?>
                                                <option value="<?php echo $employers->cus_id; ?>" <?php
                                                if ($model->employer == $employers->cus_id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $employers->cus_id . '-' . $employers->company; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group" style=" width: 100%;">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i> วันที่ไป</div>
                                        <?php
                                        echo DatePicker::widget([
                                            'id' => 'order_date_start',
                                            'name' => 'order_date_start',
                                            //'model' => $model,
                                            //'attribute' => 'driver_license_expire',
                                            'language' => 'th',
                                            'value' => $model->order_date_start,
                                            'removeButton' => false,
                                            'readonly' => true,
                                            'disabled' => true,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group" style=" width: 100%;">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i> วันที่กลับ</div>
                                        <?php
                                        echo DatePicker::widget([
                                            'id' => 'order_date_end',
                                            'name' => 'order_date_end',
                                            //'model' => $model,
                                            //'attribute' => 'driver_license_expire',
                                            'language' => 'th',
                                            'value' => $model->order_date_end,
                                            'removeButton' => false,
                                            'readonly' => true,
                                            'disabled' => true,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <?php
                                $map_car = new \app\models\MapTruck();
                                $car = $map_car->get_map_truck();
                                ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-truck"></i> เลือกรถ</div>
                                        <select id="car_id" class="form-control" disabled="disabled">
                                            <option value="">== เลือกรถ ==</option>
                                            <?php
                                            foreach ($car as $cars):
                                                ?>
                                                <option value="<?php echo $cars['car_id']; ?>" <?php
                                                if ($model->car_id == $cars['car_id']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo "คันที่ " . $cars['car_id'] . " (" . $cars['truck_1'] . ') - (' . $cars['truck_2'] . ")"; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> 
                                <?php
                                $drivers = $driver->find()->all();
                                ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i> คนขับ 1</div>
                                        <select id="driver1" class="form-control" onchange="select_driver1(this.value)" disabled="disabled">
                                            <option value="">== เลือกคนขับ1 ==</option>
                                            <?php
                                            foreach ($drivers as $driv1):
                                                ?>
                                                <option value="<?php echo $driv1['driver_id']; ?>" <?php
                                                if ($model->driver1 == $driv1['driver_id']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $driv1['name'] . '-' . $driv1['lname']; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i> คนขับ 2</div>
                                        <select id="driver2" class="form-control" onchange="select_driver2(this.value)" disabled="disabled">
                                            <option value="">== เลือกคนขับ2 ==</option>
                                            <?php
                                            foreach ($drivers as $driv2):
                                                ?>
                                                <option value="<?php echo $driv2['driver_id']; ?>" <?php
                                                if ($model->driver2 == $driv2['driver_id']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $driv2['name'] . '-' . $driv2['lname']; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-tint"></i> น้ำมันที่กำหนด</div>
                                        <input type="text" id="oil_set" name="oil_set" class="form-control" 
                                               value="<?php echo $model->oil_set ?>" placeholder="ตัวเลขเท่านั้น..." 
                                               onkeypress="return chkNumber();"
                                               readonly="readonly"/>
                                        <div class="input-group-addon">ลิตร</div>
                                        <!--
                                        <div class="input-group-addon btn btn-default" onclick="Save_before_release()"><i class="fa fa-save"></i> บันทึก</div>
                                        -->
                                    </div>
                                </div> 
                            </div>

                        </div>

                        <div class="jumbotron" style="padding: 5px; margin-top: 0px; margin-bottom: 5px; background: none;">
                            <label>เบี้ยเลี้ยง</label>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">เบี้ยเลี้ยงคนขับ(1)</div>
                                            <input type="text" id="allowance_driver1" name="allowance_driver1" class="form-control" 
                                                   placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" 
                                                   value="<?php echo trim(substr($model->allowance_driver1, 6, 15)); ?>" readonly="readonly"/>
                                            <div class="input-group-addon">บาท</div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6"> 
                                    <div class="input-group">
                                        <div class="input-group-addon">เบี้ยเลี้ยงคนขับ(2)</div>
                                        <?php if ($model->driver2 != '') { ?>
                                            <input type="text" id="allowance_driver2" name="allowance_driver2" class="form-control" 
                                                   placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" 
                                                   value="<?php echo trim(substr($model->allowance_driver2, 6, 15)); ?>" readonly="readonly"/>
                                               <?php } else { ?>
                                            <input type="text" id="allowance_driver2" name="allowance_driver2" class="form-control" 
                                                   placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" disabled="disabled" />
                                               <?php } ?>
                                        <div class="input-group-addon">บาท</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">รายละเอียดการขน</div>
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
                                            'value' => $model->transport_date,
                                            'removeButton' => false,
                                            'readonly' => true,
                                            'disabled' => true,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        ลูกค้าต้นทาง
                                        <select id="cus_start" class="form-control" disabled="disabled">
                                            <option value="">== เลือกลูกค้า ==</option>
                                            <?php
                                            $customer = \app\models\Customer::find()->all();
                                            foreach ($customer as $cus):
                                                ?>
                                                <option value="<?php echo $cus->cus_id ?>" <?php
                                                if ($model->cus_start == $cus->cus_id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $cus->cus_id . '-' . $cus->company; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        ลูกค้าปลายทาง
                                        <select id="cus_end" class="form-control" disabled="disabled">
                                            <option value="">== เลือกลูกค้า ==</option>
                                            <?php
                                            $customer_end = \app\models\Customer::find()->all();
                                            foreach ($customer_end as $cusend):
                                                ?>
                                                <option value="<?php echo $cusend->cus_id; ?>" <?php
                                                if ($model->cus_end == $cusend->cus_id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $cusend->cus_id . '-' . $cusend->company; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        ต้นทาง
                                        <select id="changwat_start" class="form-control" disabled="disabled">
                                            <option value="">== ต้นทาง ==</option>
                                            <?php
                                            $changwat = \app\models\Changwat::find()->all();
                                            foreach ($changwat as $ch1):
                                                ?>
                                                <option value="<?php echo $ch1->changwat_id; ?>" <?php
                                                if ($model->changwat_start == $ch1->changwat_id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $ch1->changwat_name; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        ปลายทาง
                                        <select id="changwat_end" class="form-control" disabled="disabled">
                                            <option value="">== ปลายทาง ==</option>
                                            <?php
                                            foreach ($changwat as $ch2):
                                                ?>
                                                <option value="<?php echo $ch2->changwat_id; ?>" <?php
                                                if ($model->changwat_end == $ch2->changwat_id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $ch2->changwat_name; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        ประเภทสินค้า
                                        <select id="product_type" class="form-control" disabled="disabled">
                                            <option value=""> == ประเภทสินค้า ==</option>
                                            <?php
                                            $product_type = \app\models\ProductType::find()->all();
                                            foreach ($product_type as $Ptype):
                                                ?>
                                                <option value="<?php echo $Ptype['id'] ?>" <?php
                                                if ($model->product_type == $Ptype['id']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $Ptype->product_type; ?></option>
                                                    <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="jumbotron" style="padding: 5px; margin-top: 10px; margin-bottom: 5px; background: none;">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-balance-scale"></i> น้ำหนัก</div>
                                            <input type="text" id="weigh" name="weigh" class="form-control" placeholder="ตัวเลขเท่านั้น..." 
                                                   onkeypress="return chkNumber();" value="<?php echo $model->weigh; ?>" 
                                                   onkeyup="Income_Calculator(0);" readonly="readonly"/>
                                            <div class="input-group-addon">ตัน</div>
                                        </div>
                                    </div> 

                                    <input type="hidden" id="type_calculus" value="<?php echo $model->type_calculus; ?>"/>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-1 col-lg-1">
                                            <label>คิดตาม</label>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <?php $type_cal = $model->type_calculus; ?>
                                                        <input type="radio" name="r1" id="r1" onclick="Unit_price_Calculator()" disabled="disabled" <?php
                                                        if ($type_cal == 0) {
                                                            echo "checked";
                                                        }
                                                        ?>/> น้ำหนัก ตันละ 
                                                    </div>
                                                    <input type="text" id="unit_price" name="unit_price" class="form-control" placeholder="ตัวเลขเท่านั้น..." 
                                                           onkeypress="return chkNumber();" 
                                                           onkeyup="Income_Calculator(0);" 
                                                           value="<?php echo $model->unit_price; ?>" 
                                                           readonly="readonly"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-sm-6 col-md-5 col-lg-5"> 
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <input type="radio" name="r1" id="r2" onclick="Pertimes_Calculator()" disabled="disabled" <?php
                                                    if ($type_cal == 1) {
                                                        echo "checked";
                                                    }
                                                    ?>/> ต่อเที่ยว เที่ยวละ</div>
                                                <input type="text" id="per_times" name="per_times" class="form-control" placeholder="ตัวเลขเท่านั้น..." 
                                                       onkeypress="return chkNumber();"
                                                       onkeyup="Income_Calculator(1);" 
                                                       value="<?php echo $model->per_times; ?>"
                                                       readonly="readonly"/>
                                                <div class="input-group-addon">บาท</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i> รายได้</div>
                                            <input type="hidden" id="income" value="<?php echo $model->income; ?>"/>
                                            <input type="text" id="income_txt" name="income_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" readonly="readonly" value="<?php echo $model->income; ?>"/>
                                            <div class="input-group-addon">บาท</div>
                                        </div>
                                    </div>
                                </div>
                                <br/>

                            </div>
                            <!--
                            <div class="panel-footer">
                                <button type="button" class="btn btn-success btn-block btn-lg" onclick="update_assign()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                            </div>
                            -->
                        </div><!-- end panel -->
                    </div><!-- End body-->
                </div><!-- End box -->
                <!--
                    ###################### END #########################
                -->



                <!--
                    ######################### #ใบสั่งงาน ######################
                -->






                <!--
                    ###################### END #########################
                -->


                <!--
                    ######################### #ใบสั่งงาน ######################
                -->

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        ค่าเชื้อเพลิง/ระยะทาง
                        <a href="javascript:explain_after_transport()" class="pull-right">
                            <i class="fa fa-question-circle fa-2x text-orange"></i>
                        </a>

                    </div>
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
                                            <div class="input-group-addon">เลขไมล์เดิม ทะเบียน(<?php echo $car_view->truck_1; ?>)</div>
                                            <?php $old_mile = $order_model->get_old_mile($model->id, $car_view->truck_1); ?>
                                            <input type="text" id="old_mile" name="old_mile" class="form-control" readonly="readonly" value="<?php echo $old_mile; ?>"/>
                                            <div class="input-group-addon">ก.ม.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <input type="hidden" id="license_plate_1" value="<?php echo $car_view->truck_1; ?>"/>
                                                เลขไมล์เที่ยวนี้ *ทะเบียน(<?php echo $car_view->truck_1; ?>) 
                                                <a
                                                    class="popover-btn"
                                                    data-toggle="popover" 
                                                    data-placement="bottom" 
                                                    data-trigger="hover"
                                                    data-content="กรอกตัวเลขหลังเลข 0 เช่น 0020304 กรอกเป็น 20304">
                                                    <i class="fa fa-question-circle text-orange"></i></a>
                                            </div>
                                            <input type="text" id="now_mile" name="now_mile" class="form-control" value="<?php echo $model->now_mile; ?>" placeholder="... ตัวเลขเท่านั้น"
                                                   onkeypress="return chkNumber()" onkeyup="distance_calculus()"/>
                                            <div class="input-group-addon">ก.ม.</div>
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

                                <a href="javascript:explain_after_transport_expenses_all()" class="pull-right">
                                    <i class="fa fa-question-circle fa-2x text-orange"></i>
                                </a>

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
                                <a href="javascript:explain_after_transport_expenses_truck()" class="pull-right">
                                    <i class="fa fa-question-circle fa-2x text-orange"></i>
                                </a>
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
                                                    <option value="<?php echo $car_view->truck_1; ?>"><?php echo $car_view->truck_1; ?>(หัวลาก)</option>
                                                    <?php if (!empty($car_view->truck_2)) { ?>
                                                        <option value="<?php echo $car_view->truck_2; ?>"><?php echo $car_view->truck_2; ?>(พ่วง)</option>
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
                <button type="button" class="btn btn-primary" onclick="save_messages();"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                <a href="<?php echo Yii::$app->getHomeUrl(); ?>">
                    <button type="button" class="btn btn-danger"><i class="fa fa-sign-out"></i> ออกจากหน้านี้</button></a>




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



<!-- #################### POPUPO AFTER TRANSPORT -->


<div class="modal fade" id="explain_after_transport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำอธิบาย</h4>
            </div>
            <div class="modal-body" style=" color:red;">
                *ข้อมูลในส่วนนี้บันทึกหลังจากที่ทำการขนส่งกลับมายังบริษัทแล้ว<br/>
                โดยการนำใบบิลค่าน้ำมัน หรือเลขไมล์ระยะทางการวิ่งรถมาบันทึก
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="explain_after_transport_expenses_all">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำอธิบาย</h4>
            </div>
            <div class="modal-body" style=" color:red;">
                *ข้อมูลในส่วนนี้บันทึกหลังจากที่ทำการขนส่งกลับมายังบริษัทแล้ว<br/>
                เช่น ค่าทางด่วน ค่าปรับ ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="explain_after_transport_expenses_truck">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">คำอธิบาย</h4>
            </div>
            <div class="modal-body" style=" color:red;">
                *ข้อมูลในส่วนนี้บันทึกหลังจากที่ทำการขนส่งกลับมายังบริษัทแล้ว<br/>
                ข้อมูลในส่วนนี้จะเป็นการบันทึกค่าใช้จ่ายของรถ ตามทะเบียน ในรายการขนส่งนั้น ๆ <br/>
                เช่น ยางแตก ยางรั่ว ... โดยรายการที่บันทึกต้องระบุ ทะเบียนให้ชัดเจน
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- SET TEXT BOX VALUE HIDDEN -->
<input type="hidden" id="assign_id" value="<?php echo $model->assign_id; ?>"/>
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
    function delete_assign(id) {
        //var r = confirm("คุณแน่ใจหรือไม่ ...?");
        swal({title: "คุณแน่ใจหรือไม่ ...?", text: "คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่!", type: "warning", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "ใช่, ต้องการลบ!", closeOnConfirm: false},
                function () {
                    var url = "<?php echo Url::to(['order-transport/delete_assign']) ?>";
                    var data = {id: id};

                    $.post(url, data, function (success) {
                        swal("Deleted!", "ลบข้อมูลของคุณแล้ว...", "success");
                        window.location.reload();
                        return false;
                    });

                });
        /*
         if (r == true) {
         var url = "<?//php echo Url::to(['order-transport/delete_assign']) ?>";
         var data = {id: id};
         
         $.post(url, data, function (success) {
         window.location.reload();
         return false;
         });
         }
         */
    }

    function confirm_order(id) {
        var url = "<?php echo Url::to(['order-transport/confirm_order']) ?>";
        var data = {id: id};
        $.post(url, data, function (success) {
            swal("Success...", "ยืนยันการชำระเงินรายการนี้แล้ว...", "success");
            window.location.reload();
            return false;
        });
    }

    function explain_after_transport() {
        $("#explain_after_transport").modal();
    }

    function explain_after_transport_expenses_all() {
        $("#explain_after_transport_expenses_all").modal();
    }

    function explain_after_transport_expenses_truck() {
        $("#explain_after_transport_expenses_truck").modal();
    }
</script>

<?php
$this->registerJs('
       $(".popover-btn").popover(); 
            ');
?>

