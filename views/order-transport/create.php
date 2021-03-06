<style type="text/css">
    #set_page{ font-size: 12px; color: #0000ff;}
    .form-control{font-size: 12px; /*color: #0000ff;*/}
    .input-group-addon{font-size: 12px; color: #0000ff;}
</style>

<script type="text/javascript">

    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.'))
            return false;
        //ele.onKeyPress = vchar;
    }

    //เมื่อเลือกคนขับ 1 ช่องเบี้ยเลี้ยงคนขับ 1 จะ คีย์ ได้
    function select_driver1(driver1) {
        if (driver1 != '') {
            $("#allowance_driver1").prop("disabled", false);
        } else {
            $("#allowance_driver1").prop("disabled", true);
        }
    }

    //เมื่อเลือกคนขับ 2 ช่องเบี้ยเลี้ยงคนขับ 2 จะ คีย์ ได้
    function select_driver2(driver2) {
        if (driver2 != '') {
            $("#allowance_driver2").prop("disabled", false);
        } else {
            $("#allowance_driver2").prop("disabled", true);
        }
    }
</script>

<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = 'สร้างใบสั่งงาน';
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่งงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$truck_model = new \app\models\Truck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$order_model = new \app\models\OrdersTransport();
?>


<div class="row" id="set_page">
    <div class="col-sm-12 col-md-12 col-lg-12">

        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-book"></i> ใบสั่งงาน(รถภายใน)
            </div>
            <div class="box-body">
                <!--
                    #ข้อมูลใบปฏิบัติงาน
                    Comment By Kimniyom
                -->
                <div class="box box-default" style="padding: 5px;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-book"></i> ใบสั่งงานเลขที่</div>
                                    <input type="text" class="form-control" value="<?php echo $assign_id; ?>" readonly="readonly"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building-o"></i> ผู้ว่าจ้าง </div>
                                    <select id="employer" class="form-control">
                                        <option value="">== เลือกผู้ว่าจ้าง ==</option>
                                        <?php
                                        $employer = \app\models\Customer::find()->all();
                                        foreach ($employer as $employers):
                                            ?>
                                            <option value="<?php echo $employers->cus_id; ?>"><?php echo $employers->cus_id . '-' . $employers->company; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-addon btn">
                                        <a href="<?php echo Url::to(['customer/create']) ?>"
                                           class="popover-btn"
                                           data-toggle="popover" 
                                           data-placement="bottom" 
                                           data-trigger="hover"
                                           data-content="ถ้าไม่มีรายชื่อบริษัทที่ต้องการให้คุณกด เพื่อเพิ่มบริษัท">
                                            <i class="fa fa-question-circle text-orange"></i></a>
                                    </div>
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
                                    <select id="car_id" class="form-control">
                                        <option value="">== เลือกรถ ==</option>
                                        <?php
                                        foreach ($car as $cars):
                                            ?>
                                            <option value="<?php echo $cars['car_id']; ?>"><?php echo "คันที่ " . $cars['car_id'] . " (" . $cars['truck_1'] . ') - (' . $cars['truck_2'] . ")"; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-addon btn">
                                        <a href="<?php echo Url::to(['map-truck/create']) ?>"
                                           class="popover-btn"
                                           data-toggle="popover" 
                                           data-placement="bottom" 
                                           data-trigger="hover"
                                           data-content="ถ้าไม่มีรถในรายการให้คุณกด เพื่อกลับไปเพิ่มข้อมูรถก่อน ...">
                                            <i class="fa fa-question-circle text-orange"></i></a>
                                    </div>
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
                                    <select id="driver1" class="form-control" onchange="select_driver1(this.value)">
                                        <option value="">== เลือกคนขับ1 ==</option>
                                        <?php
                                        foreach ($drivers as $driv1):
                                            ?>
                                            <option value="<?php echo $driv1['driver_id']; ?>"><?php echo $driv1['name'] . '-' . $driv1['lname']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <a href="<?php echo Url::to(['driver/create']) ?>"
                                           class="popover-btn"
                                           data-toggle="popover" 
                                           data-placement="bottom" 
                                           data-trigger="hover"
                                           data-content="ถ้าต้องการเพิ่มพนักงานขับรถ ให้คุณ กด ปุ่มนี้ ...">
                                            <i class="fa fa-question-circle text-orange"></i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i> คนขับ 2</div>
                                    <select id="driver2" class="form-control" onchange="select_driver2(this.value)">
                                        <option value="">== เลือกคนขับ2 ==</option>
                                        <?php
                                        foreach ($drivers as $driv2):
                                            ?>
                                            <option value="<?php echo $driv2['driver_id']; ?>"><?php echo $driv2['name'] . '-' . $driv2['lname']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-addon">
                                        <a href="<?php echo Url::to(['driver/create']) ?>"
                                           class="popover-btn"
                                           data-toggle="popover" 
                                           data-placement="bottom" 
                                           data-trigger="hover"
                                           data-content="ถ้าต้องการเพิ่มพนักงานขับรถ ให้คุณ กด ปุ่มนี้ ...">
                                            <i class="fa fa-question-circle text-orange"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-tint"></i> น้ำมันที่กำหนด 
                                        <a 
                                            class="popover-btn"
                                            data-toggle="popover" 
                                            data-placement="bottom" 
                                            data-trigger="hover"
                                            data-content="น้ำมันที่กำหนดคือ น้ำมันที่เติมก่อนวิ่งส่งของ">
                                            <i class="fa fa-question-circle text-orange"></i></a>
                                    </div>
                                    <input type="text" id="oil_set" name="oil_set" class="form-control" value="<?php echo $model->oil_set ?>" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();"/>
                                    <div class="input-group-addon">ลิตร</div>
                                    <!--
                                    <div class="input-group-addon btn btn-default" onclick="Save_before_release()"><i class="fa fa-save"></i> บันทึก</div>
                                    -->
                                </div>
                            </div> 
                        </div>

                    </div>
                </div>
                <!--
                    ###################### END #########################
                -->

                <div class="jumbotron" style="padding: 5px; margin-top: 0px; margin-bottom: 5px;">
                    <label>เบี้ยเลี้ยง</label>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">เบี้ยเลี้ยงคนขับ(1)</div>
                                    <input type="text" id="allowance_driver1" name="allowance_driver1" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" disabled="disabled"/>
                                    <div class="input-group-addon">บาท</div>
                                </div>
                            </div>    
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <div class="input-group">
                                <div class="input-group-addon">เบี้ยเลี้ยงคนขับ(2)</div>
                                <input type="text" id="allowance_driver2" name="allowance_driver2" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" disabled="disabled"/>
                                <div class="input-group-addon">บาท</div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--
                    ######################### #ใบสั่งงาน ######################
                -->

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
                                ลูกค้าต้นทาง <a href="<?php echo Url::to(['customer/create']) ?>"
                                       class="popover-btn"
                                       data-toggle="popover" 
                                       data-placement="bottom" 
                                       data-trigger="hover"
                                       data-content="ถ้าไม่มีรายชื่อลูกค้าที่ต้องการ ให้คุณกด เพื่อเพิ่มลูกค้า">
                                        <i class="fa fa-question-circle text-orange"></i></a>
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
                                ลูกค้าปลายทาง <a href="<?php echo Url::to(['customer/create']) ?>"
                                       class="popover-btn"
                                       data-toggle="popover" 
                                       data-placement="bottom" 
                                       data-trigger="hover"
                                       data-content="ถ้าไม่มีรายชื่อลูกค้าที่ต้องการ ให้คุณกด เพื่อเพิ่มลูกค้า">
                                        <i class="fa fa-question-circle text-orange"></i></a>
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
                                ประเภทสินค้า <a href="<?php echo Url::to(['product-type/create']) ?>"
                                       class="popover-btn"
                                       data-toggle="popover" 
                                       data-placement="bottom" 
                                       data-trigger="hover"
                                       data-content="ถ้าไม่มีประเภทสินค้าที่คุณต้องการ กดเพิ่อเพิ่มประเภทสิค้า">
                                        <i class="fa fa-question-circle text-orange"></i></a>
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
                                    <input type="text" id="weigh" name="weigh" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" onkeyup="Income_Calculator(0);"/>
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

                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-block btn-lg" onclick="save_assign()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                    </div>
                </div>


            </div>
        </div>
    </div> <!--- END CONTENT -->

</div><!-- End Row -->

<!-- SET TEXT BOX VALUE HIDDEN -->
<input type="hidden" id="assign_id" value="<?php echo $assign_id; ?>"/>
<input type="hidden" id="Url_save_before_release" value="<?php echo Url::to(['save_before_release']) ?>"/>
<input type="hidden" id="Url_save_assign" value="<?php echo Url::to(['save_assign']) ?>"/>

<?php
$this->registerJs('
       $(".popover-btn").popover() 
            ');
?>