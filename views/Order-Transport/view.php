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
?>

<script type="text/javascript">
    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.'))
            return false;
        //ele.onKeyPress = vchar;
    }
</script>

<div class="row">
    <div class="col-sm-12 col-md-10 col-lg-10">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-book"></i> ใบปฏิบัติงาน(รถภายใน)
            </div>
            <div class="panel-body">
                <!--
                    #ข้อมูลใบปฏิบัติงาน
                    Comment By Kimniyom
                -->
                <div class="alert alert-warning" style="padding: 5px;">
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
                            <label class="label label-success">
                                <?php
                                $d1 = $driver->find()->where(['id' => $model->driver1])->one();
                                echo $d1['name'] . ' ' . $d1['lname'];
                                ?></label>
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
                        </div>
                    </div>
                </div>
                <!--
                    ###################### END #########################
                -->

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
                            <div class="panel panel-success">
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
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            น้ำหนัก
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="weigh" name="weigh" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                                    <div class="input-group-addon">ตัน</div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            จำนวนน้ำมันที่กำหนด
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="oil_set" name="oil_set" class="form-control" value="<?php echo $model->oil_set ?>" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                                    <div class="input-group-addon">ลิตร</div>
                                                    <div class="input-group-addon btn btn-default" onclick="Save_set_oil()"><i class="fa fa-save"></i> SAVE</div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="jumbotron" style="padding: 5px; margin-top: 10px; margin-bottom: 5px;">
                                        <label>คิดตาม</label>
                                        <input type="hidden" id="type_calculus"/>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><input type="radio" name="r1" id="r1" onclick="Unit_price_Calculator()"/> น้ำหนัก ตันละ </div>
                                                        <input type="text" id="unit_price" name="unit_price" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" onkeyup="Income_Calculator(0);" disabled="disabled"/>
                                                        <div class="input-group-addon">บาท</div>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6"> 
                                                <div class="input-group">
                                                    <div class="input-group-addon"><input type="radio" name="r1" id="r2" onclick="Pertimes_Calculator()"/> ต่อเที่ยว เที่ยวละ</div>
                                                    <input type="text" id="per_times" name="per_times" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" disabled="disabled" onkeyup="Income_Calculator(1);"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="jumbotron" style="padding: 5px; margin-top: 0px;">
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
                                                <div class="input-group-addon">รายได้</div>
                                                <input type="hidden" id="income"/>
                                                <input type="text" id="income_txt" name="income_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" readonly="readonly" value="0"/>
                                                <div class="input-group-addon">บาท</div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <!-- Table -->
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
                                                $allowance = ($rs->allowance_driver1 + $rs->allowance_driver2);
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
                                                        <a href="<?php echo Url::to(['report']) ?>" target="_blank">
                                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></a>
                                                        <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
                                <div class="panel-heading">ค่าเชื้อเพลิง</div>
                                <div class="panel-body">
                                    <div class="well well-sm">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                น้ำมันเติม
                                                <div class="input-group">
                                                    <input type="text" id="oil" name="oil" class="form-control" onkeyup="oil_calculus()" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" value="<?php echo $model->oil; ?>"/>
                                                    <div class="input-group-addon">ลิตร</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                ลิตรละ
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
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-success" onclick="save_fuel()">บันทึกเติมน้ำมัน</button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">ค่าใช้จ่ายอื่น ๆ</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">รายการ</div>
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-9 col-lg-9">  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">จำนวนเงิน</div>
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
                                                            <div class="input-group-addon">บาท</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: center;">
                                                    <button type="button" class="btn btn-success btn-block"><i class="fa fa-save"></i> บันทึก</button>
                                                </div>
                                            </div>

                                            <br/>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>รายการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: center;">รวม</td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">ระยะทาง</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">เลขไมล์เดิม</div>
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
                                                            <div class="input-group-addon">บาท</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">เลขไมล์เที่ยวนี้</div>
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
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
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
                                                            <div class="input-group-addon">ก.ม.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">สะสมเที่ยวก่อน</div>
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
                                                            <div class="input-group-addon">ก.ม.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">สะสมเที่ยวนี้</div>
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
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
                                                            <input type="text" id="login_email" name="login_email" class="form-control"/>
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
                                                            <input type="text" id="login_email" name="login_email" class="form-control" readonly="readonly"/>
                                                            <div class="input-group-addon">ลิตร</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="panel panel-danger">
                                <div class="panel-heading">ข้อความ</div>
                                <div class="panel-body">
                                    <textarea class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary">บันทึกข้อมูล</button>
                            <button type="button" class="btn btn-danger">ออกจากหน้านี้</button>
                        </div>
                        <!-- ฟอร์มกรอกขากลับ -->
                        <div role="tabpanel" class="tab-pane" id="profile">2</div>
                    </div>

                </div>
            </div>
        </div>
    </div> <!--- END CONTENT -->

    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">ใบสั่งงาน</div>
        </div>
    </div> <!-- End Panel Right -->

</div><!-- End Row -->

<!-- SET TEXT BOX VALUE HIDDEN -->
<input type="hidden" id="order_id" value="<?php echo $model->order_id; ?>"/>
<input type="hidden" id="Url_save_set_oil" value="<?php echo Url::to(['save_set_oil']) ?>"/>
<input type="hidden" id="Url_save_assign" value="<?php echo Url::to(['save_assign']) ?>"/>
<input type="hidden" id="Url_save_fuel" value="<?php echo Url::to(['save_fuel']) ?>"/>
