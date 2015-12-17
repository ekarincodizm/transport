<?php

use yii\helpers\Url;

//use miloschuman\highcharts\Highcharts;
$config = new \app\models\Config_system();
$monthFull = $config->MonthFull();
$monthVal = $config->Monthval();

$this->title = "บัญชีค่าใช้จ่ายของรถ คันที่ " . $car['car_id'] . " ทะเบียน (" . $car['truck_1'] . ") - (" . $car['truck_2'] . ")";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart"></i>
        <?php echo $this->title; ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">ปี พ.ศ.</div>
                        <select id="year" name="year" class="form-control">
                            <?php
                            $yearnow = date("Y");
                            for ($i = $yearnow; $i >= ($yearnow - 2); $i--) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo ($i + 543); ?></option>
                            <?php } ?>
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
                            if(strlen($monthnow) < 2){
                                $month = "0".$monthnow;
                            } else {
                                $month = $monthnow;
                            }
                            for ($i = 0; $i <= 11; $i++) {
                                ?>
                                <option value="<?php echo $monthVal[$i]; ?>" <?php if($month == $monthVal[$i]){ echo "selected";}?>><?php echo $monthVal[$i].'-'.$monthFull[$i]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <button type="button" class="btn btn-info btn-block" onclick="load_report()"><i class="fa fa-eye"></i> ดูรายงาน</button>
            </div>
        </div>
        
        <div id="load_report"></div>
    </div>

</div>

<!-- Script By Kimniyom -->
<?php
$this->registerJs('
    load_report();
    ');
?>
<script type="text/javascript">


    function load_report() {
        var url = "<?php echo Url::to(['report/load_report_month_select_car']) ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var car_id = "<?php echo $car['car_id']?>";
        var data = {
            year: year,
            month: month,
            car_id: car_id
        };



        $.post(url, data, function (result) {
            //alert(result);
            $("#load_report").html(result);
        });
    }

 
</script>




