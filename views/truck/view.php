<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = "ทะเบียน " . $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$config = new app\models\Config_system();
?>
<div class="panel panel-primary">
    <div class="panel-heading" style="padding-bottom: 20px;">
        <i class="fa fa-windows"></i>
        <?php echo " คันที่ " . $car_id; ?>
        <div class="pull-right">
            <a href="<?php echo yii\helpers\Url::to(['site/index']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
        </div>
    </div>
    <div class="panel-body" id="panel-body">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">เลขทะเบียน</div>
                <input type="text" class="form-control" id="license_plate"  value="<?php echo $model->license_plate; ?>" readonly="readonly">
            </div>
        </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-car text-primary"></i> ข้อมูลทั่วไป</a></li>
                <!--
                <li><a href="#history" data-toggle="tab" onclick="get_history('<?//php echo $model->id ?>')"><i class="fa fa-truck text-green"></i> ประวัติการวิ่งรถ</a></li>
                -->
                
                <li><a href="#repair" data-toggle="tab" onclick="get_repair()"><i class="fa fa-cogs text-gray"></i> ข้อมูลซ่อมบำรุง</a></li>
                <li><a href="#truck_act" data-toggle="tab" onclick="get_act()"><i class="fa fa-briefcase text-yellow"></i> การต่อทะเบียน / พรบ.</a></li>
         
                <li><a href="#annuities" data-toggle="tab" onclick="get_annuities()"><i class="fa fa-opencart text-orange"></i> ค่างวด</a></li>
                <li><a href="#price" data-toggle="tab" onclick="get_price()"><i class="fa fa-calendar text-red"></i> ค่าใช้จ่ายรวม(เดือน)</a></li>
                <?php if($model->status == '0'){ ?>
                <li><a href="javascript:set_flag()"><i class="fa fa-ban text-red"></i> จำหน่าย</a></li>
                <?php } else { ?>
                <li><a style=" color: #ff3300;"><i class="fa fa-remove"></i>สถานะ ถูกจำหน่าย</a></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="detail">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <?php if($model->status == '0'){ ?>
                            <p class="pull-right">
                                <?= Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?=
                                Html::a('<i class="fa fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ])
                                ?>
                            <?php } ?>
                            </p>
                        </div>
                        <div class="box-body">
                            <?php
                            echo DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    //'id',
                                    'license_plate',
                                    'brand',
                                    'model',
                                    'color',
                                    [
                                        'attribute' => 'date_buy',
                                        'format' => 'raw',
                                        'value' => $config->thaidate($model->date_buy),
                                        //'valueColOptions' => ['style' => 'width:30%'],
                                        'displayOnly' => true
                                    ],
                                    ['attribute' => 'price', 'format' => 'integer'],
                                    ['attribute' => 'down', 'format' => 'integer'],
                                    ['attribute' => 'period_price', 'format' => 'integer'],
                                    'period',
                                    'date_supply',
                                    [
                                        'attribute' => 'type_id',
                                        'format' => 'raw',
                                        'value' => \app\models\Typecar::find()->where(['id' => $model->type_id])->one()['type_name'],
                                        //'valueColOptions' => ['style' => 'width:30%'],
                                        'displayOnly' => true
                                    ],
                                ],
                                'mode' => 'view',
                                //'bordered' => true,
                                'striped' => true,
                                'condensed' => true,
                                'responsive' => true,
                                //'hover' => true,
                                'hAlign' => 'left',
                                'vAlign' => 'center',
                            ])
                            ?>
                        </div>
                    </div>
                </div>
                <!-- ประวัติการวิ่งรถ -->
                <div class="tab-pane" id="history">
                    <div id="load_history"></div>
                </div>

                <div class="tab-pane" id="repair">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">ปี</div>
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
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">เดือน</div>
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
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <button type="button" id="search_repair" class="btn btn-primary btn-block" onclick="get_repair()"><i class="fa fa-search"></i> คันหา</button>
                        </div> 
                    </div>
                    <div class="box box-default">
                        <div class="box-body">
                            <div id="load_repair"></div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane" id="truck_act">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <?php
                            // usage without model
                            echo '<label>วันที่ทำสัญญา</label>';
                            echo DatePicker::widget([
                                'name' => 'act_start',
                                'id' => 'act_start',
                                'value' => date('Y-m-d'),
                                'language' => 'th',
                                'removeButton' => false,
                                //'readonly' => true,
                                'options' => ['placeholder' => 'Select issue date ...'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <?php
                            // usage without model
                            echo '<label>วันที่ครบกำหนด</label>';
                            echo DatePicker::widget([
                                'name' => 'act_end',
                                'id' => 'act_end',
                                'value' => date('Y-m-d'),
                                'language' => 'th',
                                'removeButton' => false,
                                //'readonly' => true,
                                'options' => ['placeholder' => 'Select issue date ...'],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <label>จำนวนเงิน</label>
                            <input type="text" class="form-control" id="act_price" name="act_price" placeholder="ตัวเลขเท่านั้น" onkeypress="return chkNumber()"/>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <label style="color: #FFF;">.</label>
                            <button type="button" class="btn btn-success btn-block"
                                    onclick="save_act()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                        </div>
                    </div>

                    <div id="load_act"></div>

                </div>

                <div class="tab-pane" id="annuities">
                    <div class="tab-pane" id="repair">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">ปี</div>
                                        <select id="annuities_year" name="annuities_year" class="form-control">
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
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">เดือน</div>
                                        <select id="annuities_month" name="annuities_month" class="form-control">
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
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">ค่างวด</div>
                                        <input type="text" id="price_period" class="form-control" readonly="readonly" value="<?php echo $model->period_price; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <button type="button" id="search_repair" class="btn btn-primary btn-block" onclick="save_annuities()"><i class="fa fa-search"></i> บันทึก</button>
                            </div> 
                        </div>

                        <!-- Result --> 
                        <div id="load_annuities"></div>

                    </div>
                </div><!-- End Content -->

                <div class="tab-pane" id="price">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">ปี</div>
                                    <select id="year_price" name="year_price" class="form-control">
                                        <?php
                                        for ($i = $yearnow; $i >= ($yearnow - 2); $i--):
                                            ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i + 543; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">เดือน</div>
                                    <select id="month_price" name="month_price" class="form-control">
                                        <?php
                                        if (strlen($monthnow) > 1) {
                                            $month = $monthnow;
                                        } else {
                                            $month = "0" . $monthnow;
                                        }
                                        //$month_val = $config->Monthval();
                                        //$month_full = $config->MonthFull();
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
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <button type="button" id="search_repair" class="btn btn-primary btn-block" onclick="get_price()"><i class="fa fa-search"></i> คันหา</button>
                        </div> 
                    </div>
                    <div class="box box-default">
                        <div class="box-body">
                            <div id="load_price"></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.'))
            return false;
        //ele.onKeyPress = vchar;
    }
</script>

<script type="text/javascript">
    //โหลดประวัติการวิ่งรถ
    function get_history(id) {
        $("#load_history").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-green'><i></center>");
        var url = "<?php echo Url::to(['truck/load_history']) ?>";
        var data = {id: id};

        $.post(url, data, function (result) {
            $("#load_history").html(result);
        });
    }

    //ข้อมูลการซ้อมบำรุง
    function get_repair() {
        $("#load_repair").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var license_plate = "<?php echo $model->license_plate ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var url = "<?php echo Url::to(['truck/load_repair']); ?>";
        var data = {
            license_plate: license_plate,
            year: year,
            month: month
        };

        $.post(url, data, function (result) {
            $("#load_repair").html(result);
        });
    }

    //ข้อมูลการต่อทะเบียน
    function get_act() {
        $("#load_act").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var license_plate = "<?php echo $model->license_plate ?>";
        var act_start = $("#act_start").val();
        var act_end = $("#act_end").val();
        var url = "<?php echo Url::to(['truck-act/load_act']); ?>";
        var data = {
            license_plate: license_plate,
            act_start: act_start,
            act_end: act_end
        };

        $.post(url, data, function (result) {
            $("#load_act").html(result);
        });
    }

    //ข้อมูลการต่อทะเบียน
    function save_act() {
        var license_plate = "<?php echo $model->license_plate ?>";
        var act_start = $("#act_start").val();
        var act_end = $("#act_end").val();
        var act_price = $("#act_price").val()
        var car_id = "<?php echo $car_id ?>";
        var url = "<?php echo Url::to(['truck-act/save']); ?>";

        if (act_price == '') {
            $("#act_price").focus();
            return false;
        }

        if (car_id == '') {
            swal("แจ้งเตือน!", "รถทะเบียนนี้ยังไม่ได้จับคู่...!", "warning");
            return false;
        }

        var data = {
            car_id: car_id,
            license_plate: license_plate,
            act_start: act_start,
            act_end: act_end,
            act_price: act_price
        };
        $("#load_act").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        $.post(url, data, function (result) {
            $("#act_price").val("");
            get_act();
        });
    }


    //ข้อมูลค่างวด
    function get_annuities() {
        $("#load_annuities").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var license_plate = "<?php echo $model->license_plate ?>";
        var annuities_month = $("#annuities_month").val();
        var annuities_year = $("#annuities_year").val();
        var url = "<?php echo Url::to(['annuities/load_annuities']); ?>";
        var data = {
            license_plate: license_plate,
            month: annuities_month,
            year: annuities_year
        };

        $.post(url, data, function (result) {
            $("#load_annuities").html(result);
        });
    }

    //บันทึกค่างวด
    function save_annuities() {
        var license_plate = "<?php echo $model->license_plate ?>";
        var annuities_month = $("#annuities_month").val();
        var annuities_year = $("#annuities_year").val();
        var date_supply = "<?php echo $model->date_supply; ?>";
        var period_price = "<?php echo $model->period_price; ?>";
        var car_id = "<?php echo $car_id ?>";
        var url = "<?php echo Url::to(['annuities/save']); ?>";
        var data = {
            car_id: car_id,
            license_plate: license_plate,
            day: date_supply,
            month: annuities_month,
            year: annuities_year,
            period_price: period_price
        };

        if (car_id == '') {
            swal("แจ้งเตือน!", "รถทะเบียนนี้ยังไม่ได้จับคู่...!", "warning");
            return false;
        }

        $("#load_annuities").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        $.post(url, data, function (result) {
            if (result == '1') {
                swal("Alert!", "บันทึกข้อมูลซ้ำกรุณาตรวจสอบ...!", "warning");
                get_annuities();
                return false;
            } else {
                get_annuities();
            }

        });
    }

    //สรุปรายจ่าย
    function get_price() {
        $("#load_price").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-green'><i></center>");
        var url = "<?php echo Url::to(['truck/load_price']) ?>";
        var license_plate = "<?php echo $model->license_plate ?>";
        var year = $("#year_price").val();
        var month = $("#month_price").val();
        var data = {
            license_plate: license_plate,
            year: year,
            month: month
        };
        $.post(url, data, function (result) {
            $("#load_price").html(result);
        });
    }

    function set_flag() {
        swal({title: "Are you sure?",
            text: "คุณต้องการจำหน่ายรถทะเบียนนี้ ใช่ หรือ ไม่!",
            type: "warning", showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            closeOnConfirm: false},
                function () {
                    var url = "<?php echo Url::to(['truck/set_flag']) ?>";
                    var id = "<?php echo $model->id ?>";
                    var car_id = "<?php echo $car_id ?>";
                    var data = {
                        id: id,
                        car_id: car_id
                    };
                    $.post(url, data, function (result) {
                        swal("Success!", "ทำรายการสำเร็จ.", "success");
                        window.location.reload();
                    });
                    
                });
    }
</script>