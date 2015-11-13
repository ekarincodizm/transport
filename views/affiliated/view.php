<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Affiliated */

$this->title = $model->company;
$this->params['breadcrumbs'][] = ['label' => 'บริษัทรถร่วม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-building"></i> ข้อมูลบริษัท
                <div class="pull-right">
                    <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?=
                    Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
            </div>
            <div class="box-body">
                <center>
                    <div id="cropContaineroutput" class="croppic" style=" border: none;">
                        <img src="<?php echo Url::to('@web/web/images/company-icon.png') ?>" class="img-responsive"/>
                    </div>
                </center>
                <ul class="list-group">
                    <li class="list-group-item"><b>บริษัท : </b> <?php echo $model->company; ?></li>
                    <li class="list-group-item"><b>เลขเสียภาษี : </b> <?php echo $model->tax_number; ?></li>
                    <li class="list-group-item"><b>ที่อยู่ : </b> <?php echo $model->address; ?></li>
                    <li class="list-group-item"><b>เบอร์โทรศัพท์ : </b> <?php echo $model->tel; ?></li>
                </ul>
                <?php
                /*
                  DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                  'id',
                  'company_id',
                  'company',
                  'tax_number',
                  'address:ntext',
                  'tel',
                  'create_date',
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
                 */
                ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-truck"></i> รถในบริษัท
                <a href="<?php echo Url::to(['affiliated-truck/create', 'company_id' => $model->company_id, 'id' => $model->id]) ?>">
                    <button type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i></button>
                </a>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ทะเบียน</th>
                            <th>ยี่ห้อ</th>
                            <th>รุ่น</th>
                            <th>สี</th>
                            <th style=" text-align: center;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($truck as $trucks): $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $trucks['license_plate']; ?></td>
                                <td><?php echo $trucks['brand']; ?></td>
                                <td><?php echo $trucks['model']; ?></td>
                                <td><?php echo $trucks['color']; ?></td>
                                <td style=" text-align: center;">
                                    <a href="<?php echo Url::to(['affiliated-truck/view','company_id' => $trucks->company_id, '_id' => $model->id, 'id' => $trucks['id']]) ?>"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo Url::to(['affiliated-truck/update', 'company_id' => $model->company_id, '_id' => $model->id, 'id' => $trucks['id']]) ?>"><i class="fa fa-pencil"></i></a>
                                        <?=
                                        Html::a('<i class="fa fa-trash"></i>', ['affiliated-truck/delete', 'company_id' => $model->id, 'id' => $trucks['id']], [
                                            //'class' => 'btn btn-danger btn-sm',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this item?',
                                                'method' => 'post',
                                            ],
                                        ])
                                        ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
