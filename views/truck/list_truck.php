
<?php
use yii\helpers\Url;

/*
$customer = new app\models\Customer();
$config = new app\models\Config_system();
$order = new app\models\OrdersTransport();
*/
?>

<table class="table table-bordered table-striped" id="result_list_truck">
    <thead>
        <tr>
            <th>#</th>
            <th>ทะเบียนรถ</th>
            <th style="text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($truck as $rs): $i++;
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php echo $rs['license_plate'] ?>
                </td>
                <td style=" text-align: center;">
                    <a href="<?php echo Url::to(['repair/view','truck_license' => $rs['license_plate']])?>"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-car"></i></button></a>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#result_list_truck').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollY" : "250px"
        });
    });
</script>
