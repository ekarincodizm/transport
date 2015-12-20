<style type="text/css">
    table thead tr th{ text-align: center;background: #999999; color: #FFF;}
    table tbody tr td{ text-align: right;}
    table tbody tr th{ text-align: left; font-weight: normal;}
    table tfoot tr td{ text-align: right; font-weight: bold; background: #999999; color: #FFF;}
    #income{ background: #006633; color: yellow; font-weight: bold;}
    #outcome{ background: #cc0033; color: #ffffff; font-weight: bold;}
    #total{ background: #0000cc; font-weight: bold;}
</style>


<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

//use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$config = new app\models\Config_system();
$product_type = new \app\models\ProductType();
$map_driv = new \app\models\MapDriver();
$assign = new \app\models\Assign();
$outgoing = new \app\models\Outgoings();
?>


<div class="table table-responsive">
    <table class="table table-striped table-hover table-bordered" id="report_year">
        <thead>
            <tr>
                <th rowspan="2" valign="middle"><i class="fa fa-calendar"></i><br/>รหัสสั่งงาน</th>
                <th rowspan="2" valign="middle"><i class="fa fa-truck"></i><br/>เที่ยววันที่</th>
                <th rowspan="2" valign="middle"><i class="fa fa-users"></i><br/>คนขับ</th>
                <th rowspan="2" valign="middle"><i class="fa fa-list"></i><br/>รายการ</th>
                <th rowspan="2" valign="middle"></i>น้ำหนัก<br/>(ตัน)</th>
                <th rowspan="2" valign="middle">ระยะทาง<br/>(ก.ม)</th>
                <th rowspan="2" valign="middle">น้ำมัน<br/>(ลิตร)</th>
                <th rowspan="2" valign="middle">แก๊ส<br/>(ก.ก.)</th>
                <th colspan="5" style=" text-align: center;" valign="middle">ค่าใช้จ่าย</th>
                <th id="outcome" rowspan="2" style=" text-align: center; font-weight: bold;" valign="middle">รวม</th>
            </tr>
            <tr>
                <th>น้ำมัน</th>
                <th>แก๊ส</th>
                <th>ซ่อมรถ</th>
                <th>เบี้ยเลี้ยง</th>
                <th>อื่น ๆ</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $i = 0;
            $sum_row = 0;
            $sum_all = 0;

            $sum_oil = 0;
            $sum_gas = 0;
            $sum_allowance_driver = 0;
            $sum_expense = 0;
            $sum_expense_etc = 0;

            $total = 0;
            foreach ($result as $rs): $i++;
                $allowance_driver = ((int) trim(substr($rs['allowance_driver1'], 6, 10)) + (int) trim(substr($rs['allowance_driver1'], 6, 10))); //เบี้ยเลี้ยง
                $expense = $assign->sum_expense_truck_in_assignid($rs['assign_id']); //ค่าใช้จ่ายเกี่ยวกับรถ
                $expense_etc = $outgoing->sum_expense_in_assignid($rs['assign_id']); //ค่าใช้จ่ายอื่น ๆ
                $sum_row = ($rs['oil_price'] + $rs['gas_price'] + (int) $expense + $allowance_driver + (int) $expense_etc);
                $sum_all = $sum_all + $sum_row;

                $sum_oil = $sum_oil + $rs['oil_price'];
                $sum_gas = $sum_gas + $rs['gas_price'];
                $sum_allowance_driver = $sum_allowance_driver + $allowance_driver;
                $sum_expense = $sum_expense + $expense;
                $sum_expense_etc = $sum_expense_etc + $expense_etc;
                ?>
                <tr> 
                    <th><?php echo $rs['assign_id'] ?></th>
                    <th><?php echo $config->thaidate($rs['order_date_start']) . ' - ' . $config->thaidate($rs['order_date_end']) ?></th>
                    <th><?php echo $map_driv->get_driver($rs['driver1']) . ' - ' . $map_driv->get_driver($rs['driver2']) ?></th>
                    <th><?php echo $product_type->find()->where(['id' => $rs['product_type']])->one()['product_type'] ?></th>
                    <td><?php echo $rs['weigh'] ?></td>
                    <td><?php echo $rs['distance'] ?></td>
                    <td><?php echo number_format($rs['oil']) ?></td>
                    <td><?php echo number_format($rs['gas']) ?></td>
                    <!--
                        #ค่าใช้จ่าย
                    -->
                    <td><?php echo number_format($rs['oil_price'], 2) ?></td>
                    <td><?php echo number_format($rs['gas_price'], 2) ?></td>
                    <td>
                        <?php
                        echo number_format($expense, 2);
                        ?>
                        <a href="javascript:get_sub_tb('0','<?php echo $rs['assign_id']?>')"><i class="fa fa-eye"></i></a>
                    </td>
                    <td>
                        <?php
                        echo number_format($allowance_driver, 2);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo number_format($expense_etc, 2);
                        ?>
                        <a href="javascript:get_sub_tb('1','<?php echo $rs['assign_id']?>')"><i class="fa fa-eye"></i></a>
                    </td>
                    <td id="outcome">
                        <?php
                        echo number_format($sum_row, 2);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" style=" text-align: center;">รวม</td>
                <td><?php echo number_format($sum_oil, 2); ?></td>
                <td><?php echo number_format($sum_gas, 2); ?></td>
                <td><?php echo number_format($sum_allowance_driver, 2); ?></td>
                <td><?php echo number_format($sum_expense, 2); ?></td>
                <td><?php echo number_format($sum_expense_etc, 2); ?></td>
                <td><?php echo number_format($sum_all, 2); ?></td>
            </tr>
        </tfoot>
    </table> 

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="popup_sub_tb">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">รายละเอียดค่าใช้จ่าย</h4>
      </div>
      <div class="modal-body">
          <div id="sub_tb_result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function get_sub_tb(type,assign_id){
        $("#popup_sub_tb").modal();
        var url = "<?php echo Url::to(['report/get_sub_expense_round'])?>";
        var data = {type: type,assign_id: assign_id};
        
        $.post(url,data,function(result){
            $("#sub_tb_result").html(result);
        });
    }
</script>
