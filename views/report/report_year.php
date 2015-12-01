
<?php

use yii\helpers\Url;

$config = new \app\models\Config_system();
$monthFull = $config->MonthFullKey();
$monthVal = $config->Monthval();

$this->title = "รายงาน (กำไร - ขาดทุน รายปี)";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart"></i>
        กำไร - ขาดทุน(รายปี)
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">ปี พ.ศ.</div>
                        <select id="year_report" name="year_report" class="form-control">
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
                <button type="button" class="btn btn-info btn-block" onclick="load_report_year()"><i class="fa fa-eye"></i> ดูรายงาน</button>
            </div>
        </div>
    </div>
    <div id="report_year"></div>

</div>

<!-- Script By Kimniyom -->
<?php
$this->registerJs('
    load_report_year();');
?>
<script type="text/javascript">
    function load_report_year() {
        var url = "<?php echo Url::to(['report/load_report_year']) ?>";
        var year = $("#year_report").val();
        var data = {year: year};

        $.post(url, data, function (result) {
            $("#report_year").html(result);
        });
    }
</script>
