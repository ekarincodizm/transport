
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $config = new app\models\Config_system();
  $order = new app\models\OrdersTransport();
 */
use yii\helpers\Html;

$config = new app\models\Config_system();
/* @var $this yii\web\View */
/* @var $model app\models\Repair */

$this->title = 'ทะเบียนรถ: ' . ' ' . $truck_license.' คันที่ '.$car_id;
$this->params['breadcrumbs'][] = 'บันทึกรายการซ่อม: ' . $truck_license;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-cogs"></i> <?php echo $this->title; ?>
        <div class="pull-right">
            <a href="<?php echo Url::to(['repair/create', 'truck_license' => $truck_license,'car_id' => $car_id]) ?>">
                <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มรายการซ่อม</button>
            </a>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
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
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
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
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <button id="" class="btn btn-info btn-block" onclick="load_repair();"><i class="fa fa-search"></i> ค้นหา</button>
            </div>
        </div>

        <div id="result_repair"></div>

    </div>
</div>
<script type="text/javascript">
//function เพิ่มรายรับพนักงาน
    //load_repair();
    
    <?php
    $this->registerJs('
        $(function () {
            load_repair();
        });
        ');
    ?>

    function load_repair() {
        $("#result_repair").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x'><i></center>");
        var url = "<?php echo Url::to(['repair/load_repair']) ?>";
        var truck_licenses = "<?php echo $truck_license; ?>";
        var month = $("#month").val();
        var year = $("#year").val();
        var car_id = "<?php echo $car_id ?>";
        var data = {
            truck_licenses: truck_licenses,
            month: month,
            year: year,
            car_id: car_id
        };

        $.post(url, data, function (result) {
            //swal("สำเร็จ", "ระบบบันทึกข้อมูลของคุณแล้ว", "success");
            $("#result_repair").html(result);
        });
    }
</script>