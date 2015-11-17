<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->company;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-danger">
    <div class="box-body">
        <h4>บริษัท <?php echo $model->company; ?></h4>
        <p><?php echo $model->detail;?></p>
    </div>
</div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-building"></i> ข้อมูลทั่วไป</a></li>
        <li><a href="#history" data-toggle="tab" onclick="get_history('<?php echo $model->cus_id ?>')"><i class="fa fa-truck"></i> ประวัติการว่าจ้าง</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="detail">
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-building"></i> <?= Html::encode($this->title) ?>
                    <div class="pull-right">
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
                    </div>
                </div>
                <div class="box-body">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'cus_id',
                            'company',
                            'tax_number',
                            'address',
                            'tel',
                            'agent',
                            'detail',
                            'create_date',
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="history">
            <div id="result-history-transport" class="table table-responsive"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_history(employer) {
        $("#result-history-transport").html("<br/><center><i class='fa fa-spinner fa-spin fa-2x text-red'><i></center>");
        var url = "<?php echo Url::to(['customer/get_history_transport']) ?>";
        var data = {employer: employer};

        $.post(url, data, function (result) {
            $("#result-history-transport").html(result);
        });
    }
</script>
