<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = "ทะเบียน " . $model->license_plate;
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$config = new app\models\Config_system();
?>
<div class="truck-view">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">เลขทะเบียน</div>
            <input type="text" class="form-control" id="license_plate"  value="<?php echo $model->license_plate; ?>" readonly="readonly">
        </div>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-car"></i> ข้อมูลทั่วไป</a></li>
            <li><a href="#history" data-toggle="tab" onclick="get_history('<?php echo $model->id ?>')"><i class="fa fa-truck"></i> ประวัติการวิ่งรถ</a></li>
            <li><a href="#repair" data-toggle="tab" onclick="get_repair()"><i class="fa fa-cogs"></i> ข้อมูลซ่อมบำรุง</a></a></li>
            <li><a href="#truck_register" data-toggle="tab" onclick=""><i class="fa fa-briefcase"></i> การต่อทะเบียน</a></a></li>
            <li><a href="#act" data-toggle="tab" onclick=""><i class="fa fa-fax"></i> พรบ.</a></a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="detail">
                <div class="box box-default">
                    <div class="box-header with-border">
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
        </div><!-- End Content -->
    </div>
</div>


<script type="text/javascript">
    //โหลดประวัติการวิ่งรถ
    function get_history(id){
        $("#load_history").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-green'><i></center>");
        var url = "<?php echo Url::to(['truck/load_history'])?>";
        var data = {id: id};
        
        $.post(url,data,function(result){
            $("#load_history").html(result);
        });
    }
    
    //ข้อมูลการซ้อมบำรุง
    function get_repair(){
        $("#load_repair").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var license_plate = "<?php echo $model->license_plate ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var url = "<?php echo Url::to(['truck/load_repair']);?>";
        var data = {
            license_plate: license_plate,
            year: year,
            month: month
        };
        
        $.post(url,data,function(result){
            $("#load_repair").html(result);
        });
    }
</script>