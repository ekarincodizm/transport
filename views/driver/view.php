<style tyle="text/css">
    .croppic{
        max-width:200px;
        min-height:250px;
        background: #FFF;
    }
</style>
<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'พนักงานขับรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$config = new app\models\Config_system();
$SalaryMasterModel = new \app\models\SalaryMaster();

?>

<script type="text/javascript">
    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.'))
            return false;
        //ele.onKeyPress = vchar;
    }
</script>
<div class="panel panel-primary">
    <div class="panel-heading" style=" padding-bottom:20px;">
        <i class="fa fa-windows"></i>
        <div class="pull-right">
            <a href="<?php echo yii\helpers\Url::to(['site/index']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
        </div>
    </div>
    <div class="panel-body" id="panel-body">
        <!-- Main content -->
        <input type="hidden" id="employee" name="employee" value="<?php echo $model->driver_id; ?>"/>
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <center>
                                <div id="cropContaineroutput" class="croppic">
                                    <?php if (!empty($model->images)) { ?>
                                        <img src="<?php echo Url::to('@web/web/uploads/profile/' . $model->images) ?>" class="img-responsive"/>
                                    <?php } else { ?>
                                        <img src="<?php echo Url::to('@web/web/images/No_image.jpg') ?>" class="img-responsive"/>
                                    <?php } ?>
                                </div>
                            </center>
                            <h3 class="profile-username text-center"><?php echo $model->name . ' ' . $model->lname; ?></h3>

                            <p class="text-muted text-center">พนักงานขับรถ</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>อายุ</b> <a class="pull-right"><?php echo $config->get_age($model->birth); ?> ปี</a>
                                </li>
                                <li class="list-group-item">
                                    <b>เลขที่ใบขับขี่</b> <a class="pull-right"><?php echo $model->driver_license_id; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>วันหมดอายุ</b> <a class="pull-right"><?php echo $config->thaidate($model->driver_license_expire); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <?php
                                    if ($config->Datediff(date("Y-m-d"), $model->driver_license_expire) < 0) {
                                        echo "<font style='color:red;'>";
                                        echo "<b>หมดอายุ </b><a class=\"pull-right\">" . (+-$config->Datediff(date("Y-m-d"), $model->driver_license_expire)) . ' วัน</a>';
                                    } else {
                                        echo "<font style='color:green;'>";
                                        echo "<b>เหลือ </b><a class=\"pull-right\">" . $config->Datediff(date("Y-m-d"), $model->driver_license_expire) . ' วัน</a>';
                                    }

                                    echo "</font>";
                                    ?>
                                </li>

                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab"><i class="fa fa-user"></i> ข้อมูลทั่วไป</a></li>
                            <li><a href="#timeline" data-toggle="tab" onclick="get_history('<?php echo $model->driver_id ?>')"><i class="fa fa-truck"></i> ประวัติการวิ่งรถ</a></li>
                            <li><a href="#salary" data-toggle="tab" onclick="load_salary('<?php echo $model->driver_id ?>');"><i class="fa fa-dollar"></i> บัญชีเงินเดือน</a></li>
                            <li><a href="#income" data-toggle="tab" onclick="load_income();"><i class="fa fa-download"></i> รายรับ</a></li>
                            <li><a href="#expenses" data-toggle="tab" onclick="load_expenses_driver();"><i class="fa fa-upload"></i> รายจ่าย</a></li>
                            <li><a href="#income_expenses" data-toggle="tab" onclick="load_income_expenses();"><i class="fa fa-file-text-o"></i> สรุป(รับ - จ่าย)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo $this->title; ?>
                                        <div style="text-align: right; float: right;">
                                            <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => '']) ?>
                                            <?=
                                            Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
                                                'class' => '',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                                <?=
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        'id',
                                                        'driver_id',
                                                        'name',
                                                        'lname',
                                                        'card_id',
                                                        [
                                                            'attribute' => 'birth',
                                                            'format' => 'raw',
                                                            'value' => $config->get_age($model->birth) . ' ปี',
                                                            //'valueColOptions' => ['style' => 'width:30%'],
                                                            'displayOnly' => true
                                                        ],
                                                        'address',
                                                        'tel1',
                                                        'tel2',
                                                        'driver_license_id',
                                                        'driver_license_expire',
                                                        'create_date'
                                                    ],
                                                ])
                                                ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <div id="history"></div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="salary">
                                <div class="box box-success">
                                    <div class=" box-header with-border">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">เงินเดือนปัจจุบัน</div>
                                                        <?php $salary_active = $SalaryMasterModel->find()->where(['employee' => $model->driver_id, 'active' => 1])->one()['salary']; ?>
                                                        <input type="text" id="salary_price" name="salary_price" value="<?php echo $salary_active; ?>" readonly="readonly" class="form-control"/>
                                                        <div class="input-group-addon">บาท</div>
                                                        <div class="input-group-addon btn btn-default" onclick="dialog_salary_master()">กำหนดเงินเดือน</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">ประจำเดือน</div>
                                                        <select id="month" name="month" class="form-control">
                                                            <?php
                                                            $monthnow = date("m");
                                                            if (strlen($monthnow) > 1) {
                                                                $month = $monthnow;
                                                            } else {
                                                                $month = "0" . $monthnow;
                                                            }
                                                            $month_val = $config->Monthval();
                                                            $month_full = $config->MonthFull();
                                                            for ($i = 0; $i <= 11; $i++):
                                                                ?>
                                                                <option value="<?php echo $month_val[$i]; ?>" <?php
                                                                if ($month_val[$i] == $month) {
                                                                    echo "selected = 'selected' ";
                                                                }
                                                                ?>>
                                                                            <?php echo $month_val[$i] . " - " . $month_full[$i]; ?>
                                                                </option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">ประจำปี</div>
                                                        <select id="year" name="year" class="form-control">
                                                            <?php
                                                            $yearnow = date("Y");
                                                            for ($i = $yearnow; $i >= ($yearnow - 2); $i--):
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i + 543; ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                                <button id="" class="btn btn-success btn-block" onclick="save_salary();"><i class="fa fa-money"></i> จ่ายเงินเดือน</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive" id="result-salary">

                                    </div>
                                    <div class=" box-footer">

                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-pane -->

                            <!--
                            ################ Tab บันทึกรายรับ พนักงาน ################
                            -->
                            <div class="tab-pane" id="income">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ประจำเดือน</div>
                                                <select id="month_income" name="month_income" class="form-control" onchange="load_income()">
                                                    <?php
                                                    /* $monthnow = date("m");
                                                      if (strlen($monthnow) > 1) {
                                                      $month = $monthnow;
                                                      } else {
                                                      $month = "0" . $monthnow;
                                                      }
                                                      $month_val = $config->Monthval();
                                                      $month_full = $config->MonthFull();
                                                     * 
                                                     */
                                                    for ($a = 0; $a <= 11; $a++):
                                                        ?>
                                                        <option value="<?php echo $month_val[$a]; ?>" <?php
                                                        if ($month_val[$a] == $month) {
                                                            echo "selected = 'selected' ";
                                                        }
                                                        ?>>
                                                                    <?php echo $month_val[$a] . " - " . $month_full[$a]; ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ประจำปี</div>
                                                <select id="year_income" name="year_income" class="form-control" onchange="load_income()">
                                                    <?php
                                                    //$yearnow = date("Y");
                                                    for ($b = $yearnow; $b >= ($yearnow - 2); $b--):
                                                        ?>
                                                        <option value="<?php echo $b; ?>"><?php echo $b + 543; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">รายการ</div>
                                                <input type="text" id="detail_income" name="detail_income" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ราคา</div>
                                                <input type="text" id="price_income" name="price_income" class="form-control" placeholder="ตัวเลขเท่านั้น ..." onkeypress="return chkNumber()"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                        <button id="" class="btn btn-success btn-block" onclick="save_income();"><i class="fa fa-save"></i> บันทึก</button>
                                    </div>
                                </div>

                                <div id="load_income" class="table-responsive"></div>

                            </div>

                            <!--
                            ################ Tab บันทึกรายจ่ายพนักงาน ################
                            -->
                            <div class="tab-pane" id="expenses">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ประจำเดือน</div>
                                                <select id="month_expenses" name="month_expenses" class="form-control" onchange="load_expenses_driver()">
                                                    <?php
                                                    /* $monthnow = date("m");
                                                      if (strlen($monthnow) > 1) {
                                                      $month = $monthnow;
                                                      } else {
                                                      $month = "0" . $monthnow;
                                                      }
                                                      $month_val = $config->Monthval();
                                                      $month_full = $config->MonthFull();
                                                     * 
                                                     */
                                                    for ($c = 0; $c <= 11; $c++):
                                                        ?>
                                                        <option value="<?php echo $month_val[$c]; ?>" <?php
                                                        if ($month_val[$c] == $month) {
                                                            echo "selected = 'selected' ";
                                                        }
                                                        ?>>
                                                                    <?php echo $month_val[$c] . " - " . $month_full[$c]; ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ประจำปี</div>
                                                <select id="year_expenses" name="year_expenses" class="form-control" onchange="load_expenses_driver()">
                                                    <?php
                                                    //$yearnow = date("Y");
                                                    for ($d = $yearnow; $d >= ($yearnow - 2); $d--):
                                                        ?>
                                                        <option value="<?php echo $d; ?>"><?php echo $d + 543; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">รายการ</div>
                                                <input type="text" id="detail_expenses" name="detail_expenses" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ราคา</div>
                                                <input type="text" id="price_expenses" name="price_expenses" class="form-control" placeholder="ตัวเลขเท่านั้น ..." onkeypress="return chkNumber()"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                        <button class="btn btn-info btn-block" onclick="save_expenses_driver();"><i class="fa fa-save"></i> บันทึก</button>
                                    </div>
                                </div>

                                <div id="result_expenses" class="table-responsive"></div>

                            </div>

                            <div class="tab-pane" id="income_expenses">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ประจำเดือน</div>
                                                <select id="month_income_expenses" name="month_income_expenses" class="form-control" onchange="load_income_expenses()">
                                                    <?php
                                                    /* $monthnow = date("m");
                                                      if (strlen($monthnow) > 1) {
                                                      $month = $monthnow;
                                                      } else {
                                                      $month = "0" . $monthnow;
                                                      }
                                                      $month_val = $config->Monthval();
                                                      $month_full = $config->MonthFull();
                                                     * 
                                                     */
                                                    for ($j = 0; $j <= 11; $j++):
                                                        ?>
                                                        <option value="<?php echo $month_val[$j]; ?>" <?php
                                                        if ($month_val[$j] == $month) {
                                                            echo "selected = 'selected' ";
                                                        }
                                                        ?>>
                                                                    <?php echo $month_val[$j] . " - " . $month_full[$j]; ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">ประจำปี</div>
                                                <select id="year_income_expenses" name="year_income_expenses" class="form-control" onchange="load_income_expenses()">
                                                    <?php
                                                    //$yearnow = date("Y");
                                                    for ($k = $yearnow; $k >= ($yearnow - 2); $k--):
                                                        ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $k + 543; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div id="result_income_expenses" class="table-responsive"></div>

                            </div>

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
</div>


<!-- //////////////////////////////////////////////////////////////////////////-->


<!--
    ########### Dialog เพิ่มเงินเดือนพนักงาน ##############
-->
<div class="modal modal-defalut" id="dialog_salary_master">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-dollar"></i> ปรับเงินเดือนพนักงาน</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">ปรับเงินเดือนใหม่</div>
                        <input type="text" class="form-control" id="salary_new" placeholder="ตัวเลขเท่านั้น" onkeypress="return chkNumber()"/>
                        <div class="input-group-addon">บาท</div>
                        <div class="input-group-addon btn btn-default" onclick="save_salary_master();"><i class="fa fa-save"></i> บันทึก</div>
                    </div>
                </div>

                <div class="box bax-info">
                    <div class="box-body">
                        <div id="result-salary-moaster"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$url = Url::to(['driver/img_crop_to_file', 'id' => $model->id]);
$this->registerJs(
        "var croppicContaineroutputOptions = {
        uploadUrl: '" . Yii::$app->urlManager->createUrl('driver/img_save_to_file') . "',
        cropUrl: '" . $url . "',
        outputUrlId: 'cropOutput',
        modal: false,
        loaderHtml: '<div class=\"loader bubblingG\"><span id=\"bubblingG_1\"></span><span id=\"bubblingG_2\"></span><span id=\"bubblingG_3\"></span></div> ',
        onBeforeImgUpload: function () {
            console.log('onBeforeImgUpload')
        },
        onAfterImgUpload: function () {
            console.log('onAfterImgUpload')
        },
        onImgDrag: function () {
            console.log('onImgDrag')
        },
        onImgZoom: function () {
            console.log('onImgZoom')
        },
        onBeforeImgCrop: function () {
            console.log('onBeforeImgCrop')
        },
        onAfterImgCrop: function () {
            window.location.reload();
            console.log('onAfterImgCrop')
        },
        onReset: function () {
            console.log('onReset')
        },
        onError: function (errormessage) {
            console.log('onError:' + errormessage)
        }
    }

    var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);
"
);
?>

<script type="text/javascript">
    //ประวัติการวิ่งรถ
    function get_history(driver_id) {
        $("#history").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['history']) ?>";
        var data = {driver_id: driver_id};

        $.post(url, data, function (result) {
            $("#history").html(result);
        });
    }

    //ประวัติการรับเงินเดือน
    function load_salary() {
        $("#result-salary").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['salary/load_salary']) ?>";
        var employee = $("#employee").val();
        var data = {employee: employee};

        $.post(url, data, function (result) {
            $("#result-salary").html(result);
        });
    }

    //เปิด popup dialog master
    function dialog_salary_master() {
        $("#dialog_salary_master").modal();
        load_salary_master();
    }

    //ข้อมูลการขึ้นเงินเดือน
    function load_salary_master() {
        var employee = $("#employee").val();
        $("#result-salary-moaster").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x'><i></center>");
        var url = "<?php echo Url::to(['salary-master/salary_master']) ?>";
        var data = {employee: employee};

        $.post(url, data, function (result) {
            $("#result-salary-moaster").html(result);
        });
    }

    //ฟังก์ชันบันทึกข้อมูลปรับเงินเดือนพนักงาน
    function save_salary_master() {
        var salary = $("#salary_new").val();
        var employee = $("#employee").val();

        if (salary == '') {
            $("#salary_new").focus();
            return false;
        }

        var url = "<?php echo Url::to(['salary-master/save_salary_master']) ?>";
        var data = {salary: salary, employee: employee};
        $.post(url, data, function (success) {
            load_salary_master();
        });
    }

    //ฟังก์ชันบันทึกเงินเดือนพนักงานในแต่ละเดือน
    function save_salary() {
        var url = "<?php echo Url::to(['salary/save']) ?>";
        var salary = $("#salary_price").val();
        var employee = $("#employee").val();
        var month = $("#month").val();
        var year = $("#year").val();

        var data = {
            salary: salary,
            employee: employee,
            month: month,
            year: year
        };

        $.post(url, data, function (result) {
            if (result == '1') {
                swal("แจ้งเตือน!", "จ่ายเงินเดือนพนักงานคนนี้ไปแล้ว", "warning");
                return false;
            } else {
                swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
                load_salary();
            }
        });

    }

    //function เพิ่มรายรับพนักงาน
    function save_income() {
        var url = "<?php echo Url::to(['driver-income/save']) ?>";
        var price_income = $("#price_income").val();
        var detail_income = $("#detail_income").val();
        var employee = $("#employee").val();
        var month_income = $("#month_income").val();
        var year_income = $("#year_income").val();

        if (price_income == '' || detail_income == '') {
            swal("แจ้งเตือน!", "กรอกข้อมูลไม่ครบ ...!", "warning");
            return false;
        }

        var data = {
            price_income: price_income,
            detail_income: detail_income,
            employee: employee,
            month_income: month_income,
            year_income: year_income
        };

        $.post(url, data, function (result) {
            $("#price_income").val("");
            $("#detail_income").val("");
            swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
            load_income();
        });
    }

    //function เพิ่มรายรับพนักงาน
    function load_income() {
        $("#load_income").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x'><i></center>");
        var url = "<?php echo Url::to(['driver-income/load_income']) ?>";
        var employee = $("#employee").val();
        var month_income = $("#month_income").val();
        var year_income = $("#year_income").val();

        var data = {
            employee: employee,
            month: month_income,
            year: year_income
        };

        $.post(url, data, function (result) {
            //swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
            $("#load_income").html(result);
        });
    }


    //function เพิ่มรายจ่ายพนักงาน
    function save_expenses_driver() {

        var url = "<?php echo Url::to(['driver-expenses/save']) ?>";
        var price_expenses = $("#price_expenses").val();
        var detail_expenses = $("#detail_expenses").val();
        var employee = $("#employee").val();
        var month_expenses = $("#month_expenses").val();
        var year_expenses = $("#year_expenses").val();

        if (price_expenses == '' || detail_expenses == '') {
            swal("แจ้งเตือน!", "กรอกข้อมูลไม่ครบ ...!", "warning");
            return false;
        }

        var data = {
            price_expenses: price_expenses,
            detail_expenses: detail_expenses,
            employee: employee,
            month_expenses: month_expenses,
            year_expenses: year_expenses
        };

        $.post(url, data, function (result) {
            $("#price_expenses").val("");
            $("#detail_expenses").val("");
            swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
            load_expenses_driver();
        });
    }

    //function แสดงรายจ่ายพนักงาน
    function load_expenses_driver() {
        $("#result_expenses").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x'><i></center>");
        var url = "<?php echo Url::to(['driver-expenses/load_expenses']) ?>";
        var employee = $("#employee").val();
        var month_expenses = $("#month_expenses").val();
        var year_expenses = $("#year_expenses").val();

        var data = {
            employee: employee,
            month: month_expenses,
            year: year_expenses
        };
        $.post(url, data, function (result) {
            //swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
            $("#result_expenses").html(result);
        });
    }

    //function รายรับรายจ่าย
    function load_income_expenses() {
        $("#result_income_expenses").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x'><i></center>");
        var url = "<?php echo Url::to(['driver/load_income_expenses']) ?>";
        var employee = $("#employee").val();
        var month = $("#month_income_expenses").val();
        var year = $("#year_income_expenses").val();

        var data = {
            employee: employee,
            month: month,
            year: year
        };
        $.post(url, data, function (result) {
            //swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
            $("#result_income_expenses").html(result);
        });
    }
</script>