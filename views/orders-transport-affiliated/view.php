<style type="text/css">
    #set_page{ font-size: 12px; color: #ff0000;}
    .form-control{font-size: 12px; /*color: #0000ff;*/}
    .input-group-addon{font-size: 12px; color: #ff0000;}
</style>
<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'ใบปฏิบัติงาน(จ้างบริษัทรถร่วม)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$truck_model = new \app\models\AffiliatedTruck();
$config = new \app\models\Config_system();
$driver = new app\models\Driver();
$customer_model = new \app\models\Customer();
$changwat_model = new app\models\Changwat();
$order_model = new \app\models\OrdersTransportAffiliated();
?>

<script type="text/javascript">
    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.'))
            return false;
        //ele.onKeyPress = vchar;
    }
</script>
<p>
    <?= Html::a('<i class="fa fa-pencil"></i> แก้ไขใบปฏิบัติงาน', ['update', 'id' => $model->id], ['class' => 'btn btn-default btn-xs']) ?>
</p>
<div class="row" id="set_page">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-book"></i> ใบปฏิบัติงาน(จ้างบริษัทรถร่วม)
                <div class="box-tools pull-right">
                    <a href="<?php echo Url::to(['bill', 'id' => $model->id]) ?>" target="_bank">
                        <button type="button" class="btn btn-default btn-box-tool"><i class="fa fa-newspaper-o"></i> ออกบิลใบแจ้งหนี้</button></a>
                    <a href="<?php echo Url::to(['incom_outcome', 'id' => $model->id]) ?>" target="_bank">
                        <button type="button" class="btn btn-default btn-box-tool"><i class="fa fa-file-text-o"></i> รายละเอียด(รับ - จ่าย)</button></a>
                    <a href="<?php echo Url::to(['receipt', 'id' => $model->id]) ?>" target="_bank">
                        <button type="button" class="btn btn-default btn-box-tool"><i class="fa fa-file-text-o"></i> ออกใบเสร็จ</button></a>
                </div>
               
            </div>
            <div class="box-body">
               
                <!--
                    #ข้อมูลใบปฏิบัติงาน
                    Comment By Kimniyom
                -->
                <div class="box box-danger" style="padding: 5px;">
                    <div class="box-header with-border">
                        ผู้ว่าจ้าง
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-book"></i> ใบบฏิบัติงาน</div>
                                        <input type="text" class="form-control" value="<?php echo $model->order_id; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-building-o"></i> ผู้ว่าจ้าง</div>
                                        <input type="text" class="form-control" value="<?php echo $customer_model->find()->where(['cus_id' => $model->employer])->one()['company']; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i> วันที่ไป</div>
                                        <input type="text" class="form-control" value="<?php echo $config->thaidate($model->order_date_start); ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i> วันที่กลับ</div>
                                        <input type="text" class="form-control" value="<?php echo $config->thaidate($model->order_date_end); ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- ข้อมูลบริษัทรถร่วม -->
                <div class="box box-danger" style="padding: 5px;">
                    <div class=" box-header with-border">
                        บริษัทรถร่วม
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <?php $rs_truck = $truck_model->find()->where(['id' => $model->truck1])->one(); ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-truck"></i> ทะเบียนรถ</div>
                                        <input type="text" class="form-control" value="<?php echo $rs_truck['license_plate']; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <?php
                                $rs_truck2 = $truck_model->find()->where(['id' => $model->truck2])->one();
                                if (!empty($rs_truck2)) {
                                    $car_truck2 = $rs_truck2['license_plate'];
                                } else {
                                    $car_truck2 = " -";
                                }
                                ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-truck"></i> ทะเบียนพ่วง</div>
                                        <input type="text" class="form-control" value="<?php echo $car_truck2; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3"> 
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i> คนขับ 1</div>
                                        <input type="text"  class="form-control" value="<?php echo $model->driver1; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i> คนขับ 2</div>
                                        <input type="text"  class="form-control" value="<?php echo $model->driver2; ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--
                    ###################### END #########################
                -->

                <!--
                    ######################### #ใบสั่งงาน ######################
                -->

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-truck"></i> <i class="fa fa-angle-up"></i> ใบสั่งงาน</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- ฟอร์มกรอกขาไป -->
                        <div class="active tab-pane" id="home">
                            <div class="panel panel-danger">
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
                                                        <div class="input-group-addon"><input type="radio" name="r1" id="r1" onclick="Unit_price_Calculator_affiliated()"/> น้ำหนัก ตันละ </div>
                                                        <input type="text" id="unit_price" name="unit_price" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" onkeyup="Income_Calculator_affiliated(0);" disabled="disabled"/>
                                                        <div class="input-group-addon">บาท</div>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="col-sm-6 col-md-5 col-lg-5"> 
                                                <div class="input-group">
                                                    <div class="input-group-addon"><input type="radio" name="r1" id="r2" onclick="Pertimes_Calculator_affiliated()"/> ต่อเที่ยว เที่ยวละ</div>
                                                    <input type="text" id="per_times" name="per_times" class="form-control" placeholder="ตัวเลขเท่านั้น..." onkeypress="return chkNumber();" disabled="disabled" onkeyup="Income_Calculator_affiliated(1);"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-dollar"></i> รวม</div>
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
                                            <button type="button" class="btn btn-default" style=" border-radius: 0px;">
                                                <i class="fa fa-print"></i> พิมพ์ใบสั่งงานทั้งหมด(สำหรับบริษัทรถร่วม)
                                            </button></a>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>วันที่ขน</th>
                                                    <th>ลูกค้า</th>
                                                    <th>เส้นทาง</th>
                                                    <th>ลูกค้าปลายทาง</th>
                                                    <th>เลขที่ใบขน</th>
                                                    <th>รายได้</th>
                                                    <th style="text-align: center;">ตัวเลือก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $sum = array(0, 0);
                                                foreach ($assign as $rs): $i++;
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
                                                    <td style="text-align: right; color: #ff0000; font-weight: bold;"><?php echo number_format($sum[1], 2); ?></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- END Well -->
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-success btn-block btn-lg" onclick="save_assign_affiliated()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                                </div>
                            </div>
                            <hr/>

                            <div class="panel panel-danger">
                                <div class=" panel-heading">
                                    ค่าใช้จ่าย/รายได้
                                </div>
                                <div class=" panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-money"></i> ค่าขนส่ง</div>
                                                <input type="hidden" id="price_employer" value="<?php echo $sum[1]; ?>"/>
                                                <input type="text" id="price_employer_txt" name="price_employer_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" readonly="readonly" value="<?php echo number_format($sum[1]); ?>"/>
                                                <div class="input-group-addon">บาท</div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-money"></i> ราคาจ้างบริษัทร่วม</div>
                                                <input type="text" id="price_affiliated_txt" name="price_affiliated_txt" class="form-control" 
                                                       style="font-size: 20px; text-align: center; color: #ff0033;" value="<?php echo $model->price_affiliated; ?>" 
                                                       onkeypress="return chkNumber()" onkeyup="Calculator_total()"/>
                                                <div class="input-group-addon">บาท</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-danger">
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <input type="hidden" id="income_total" name="income_total"/>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-money"></i> รายได้</div>             
                                                    <input type="text" id="income_total_txt" name="income_total_txt" class="form-control" style="font-size: 20px; text-align: center; color: #ff0033;" value="0" readonly="readonly"/>
                                                    <div class="input-group-addon">บาท</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 
                            #### END panel-success ####
                            -->
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
                    </div>
                </div>
            </div>
        </div>
    </div> <!--- END CONTENT -->

</div><!-- End Row -->

<!-- SET TEXT BOX VALUE HIDDEN -->
<input type="hidden" id="order_id" value="<?php echo $model->order_id; ?>"/>
<input type="hidden" id="Url_save_assign" value="<?php echo Url::to(['save_assign']) ?>"/>
<input type="hidden" id="Url_save_fuel" value="<?php echo Url::to(['save_fuel']) ?>"/>
<input type="hidden" id="Url_save_message" value="<?php echo Url::to(['save_message']) ?>"/>


<!-- รายรับ - รายจ่าย เที่ยวนี้ -->
<script type="text/javascript">
    function delete_assign(id) {
        //var r = confirm("คุณแน่ใจหรือไม่ ...?");
        swal({title: "คุณแน่ใจหรือไม่ ...?", text: "คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่!", type: "warning", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "ใช่, ต้องการลบ!", closeOnConfirm: false},
        function () {
            var url = "<?php echo Url::to(['orders-transport-affiliated/delete_assign']) ?>";
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
</script>

