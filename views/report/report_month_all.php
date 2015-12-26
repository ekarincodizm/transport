<?php

use yii\helpers\Url;

//use miloschuman\highcharts\Highcharts;
$config = new \app\models\Config_system();
$monthFull = $config->MonthFull();
$monthVal = $config->Monthval();

$this->title = "รายรับ รายจ่ายประจำเดือน";
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
                            if (strlen($monthnow) < 2) {
                                $month = "0" . $monthnow;
                            } else {
                                $month = $monthnow;
                            }
                            for ($i = 0; $i <= 11; $i++) {
                                ?>
                                <option value="<?php echo $monthVal[$i]; ?>" <?php
                                if ($month == $monthVal[$i]) {
                                    echo "selected";
                                }
                                ?>><?php echo $monthVal[$i] . '-' . $monthFull[$i]; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <button type="button" class="btn btn-info btn-block" onclick="load_report()"><i class="fa fa-eye"></i> ดูรายงาน</button>
            </div>
        </div>
        <!-- 
        #คำอธิบาย
        -->
        <div class="box box-danger collapsed-box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse">คำอธิบาย <i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body" style=" font-size: 12px;">
                * ค่าใช้จ่ายคิดตามคันรถ หรือหมายเลขรถ ถ้าค่าใช้จ่ายที่เกิดจากตามทะเบียนรถ ส่วนใดส่วนหนึ่งไม่ว่าส่วนหัวหรือส่วนท้าย ที่ยังไม่ได้ต่อ จะไม่นำมาคิดในรายงานนี้แต่จะไปคิดในรายงานค่าใช้จ่ายรวม<br/>
                เช่น รถทะเบียน ก ประเภทพ่วง จอดทิ้งไว้แต่ ต้องเสียค่างวดทุกเดือน ค่าใช้จ่ายนี้ก็จะไปคิดในรายงานค่าใช้จ่ายรวมไม่นำมาคิดในรายงานนี้ <br/><br/>
                ไอค่อน <i class="fa fa-list text-green"></i> คือ ปุ่มคลิกดูรายละเอียดในรายการนั้น ๆ
            </div><!-- /.box-body -->
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
        var url = "<?php echo Url::to(['report/load_report_month_all']) ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var data = {
            year: year,
            month: month,
            //car_id: car_id
        };

        $("#load_report").html('<center><i class="fa fa-spinner fa-spin fa-sz"></i> กรุณารอสักครู่ ...</center><br/><br/>');

        $.post(url, data, function (result) {
            //alert(result);
            $("#load_report").html(result);
        });
    }


</script>




