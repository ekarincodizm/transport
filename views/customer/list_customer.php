
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $config = new app\models\Config_system();
  $order = new app\models\OrdersTransport();
 */
?>

<table class="table table-striped" id="list_customer">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>บริษัท/ลูกค้า</th>
            <th style="text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($model as $rs): $i++;
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td>
                    <?php echo $rs['company']; ?>
                </td>
                <td style=" text-align: center;">
                    <a href="<?php echo Url::to(['order-transport/get_bill_customer', 'cus_id' => $rs['cus_id']]) ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-user"></i></button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#list_customer').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollY": "250px"
        });
    });
</script>
