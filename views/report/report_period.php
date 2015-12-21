
<?php

use yii\helpers\Url;

//use miloschuman\highcharts\Highcharts;
$config = new \app\models\Config_system();
$monthFull = $config->MonthFullKey();
$monthVal = $config->Monthval();

$this->title = "รายงาน (กำไร - ขาดทุน ไตรมาส)";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart"></i>
        กำไร - ขาดทุน(ไตรมาส)
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
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
            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                <button type="button" class="btn btn-info btn-block" onclick="load_report_period_1('1')"><i class="fa fa-eye"></i> ดูรายงาน</button>
            </div>
        </div>
    </div>
    
    <div id="chart"></div>
    
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#period1" data-toggle="tab" onclick="load_report_period_1('1')"> ไตรมาส 1</a></li>
            <li><a href="#period2" data-toggle="tab" onclick="load_report_period_2('2')"> ไตรมาส 2</a></li>
            <li><a href="#period3" data-toggle="tab" onclick="load_report_period_3('3')"> ไตรมาส 3</a></a></li>
            <li><a href="#period4" data-toggle="tab" onclick="load_report_period_4('4')"> ไตรมาส 4</a></a></li>
        </ul>
        <div class="tab-content" id="loadding_progass">
            <div class="active tab-pane" id="period1"></div>
            <div class="tab-pane" id="period2"></div>
            <div class="tab-pane" id="period3"></div>
            <div class="tab-pane" id="period4"></div>
        </div>
    </div>
</div>

<!-- Script By Kimniyom -->
<?php
$this->registerJs('
    load_report_period_1(1);');
?>
<script type="text/javascript">
    
    function load_chart(){
        var url = "<?php echo Url::to(['report/chart_period']) ?>";
        var year = $("#year").val();
        //alert(year);
        var data = {
            year: year
        };
        $("#chart").html('<center><i class="fa fa-spinner fa-spin fa-sz"></i> loading ...</center><br/><br/>');
        $.post(url, data, function (result) {
            //alert(result);
            $("#chart").html(result);
        });
    }
    
    function load_report_period_1(period) {
        load_chart();
        var url = "<?php echo Url::to(['report/load_report_period']) ?>";
        var year = $("#year").val();
        var data = {
            year: year,
            period: period
        };
        
        
         $("#period1").html('<center><i class="fa fa-spinner fa-spin fa-sz"></i> กรุณารอสักครู่ ...</center><br/><br/>');
        $.post(url, data, function (result) {
            //alert(result);
            $("#period1").html(result);
        });
    }
    
    function load_report_period_2(period) {
        var url = "<?php echo Url::to(['report/load_report_period']) ?>";
        var year = $("#year").val();
        var data = {
            year: year,
            period: period
        };
        $("#period2").html('<center><i class="fa fa-spinner fa-spin fa-sz"></i> กรุณารอสักครู่ ...</center><br/><br/>');
        $.post(url, data, function (result) {
            //alert(result);
            $("#period2").html(result);
        });
    }
    
    function load_report_period_3(period) {
        var url = "<?php echo Url::to(['report/load_report_period']) ?>";
        var year = $("#year").val();
        var data = {
            year: year,
            period: period
        };
        $("#period3").html('<center><i class="fa fa-spinner fa-spin fa-sz"></i> กรุณารอสักครู่ ...</center><br/><br/>');
        $.post(url, data, function (result) {
            //alert(result);
            $("#period3").html(result);
        });
    }
    
    function load_report_period_4(period) {
        var url = "<?php echo Url::to(['report/load_report_period']) ?>";
        var year = $("#year").val();
        var data = {
            year: year,
            period: period
        };
        $("#period4").html('<center><i class="fa fa-spinner fa-spin fa-sz"></i> กรุณารอสักครู่ ...</center><br/><br/>');
        $.post(url, data, function (result) {
            //alert(result);
            $("#period4").html(result);
        });
    }
</script>




