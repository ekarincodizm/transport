
<?php

use yii\helpers\Url;

/*
  $customer = new app\models\Customer();
  $config = new app\models\Config_system();
  $order = new app\models\OrdersTransport();
 */
?>

<table class="table table-striped" id="list_driver">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th></th>
            <th>ชื่อ - สกุล</th>
            <th style="text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($driver as $rs): $i++;
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td>
                    <?php if (!empty($rs['images'])) { ?>
                        <img src="<?php echo Url::to('@web/web/uploads/profile/' . $rs['images']); ?>" width="30px;"/>
                    <?php } else { ?>
                        <img src="<?php echo Url::to('@web/web/images/No_image.jpg'); ?>" style=" max-height: 50px; max-width: 30px;"/>
                    <?php } ?>
                </td>
                <td>
                    <?php echo $rs['name'] . ' - ' . $rs['lname'] ?>
                </td>
                <td style=" text-align: center;">
                    <button type="button" class="btn btn-success btn-sm" onclick="map_driver('<?php echo $rs['driver_id'] ?>')"><i class="fa fa-user"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function () {
        //$("#result_list_truck").DataTable();
        $('#list_driver').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollY": "250px"
        });
    });

    function map_driver(driver_id) {
        var car_id = "<?php echo $car_id ?>";
        var url = "<?php echo Url::to(['map-truck/map_driver']) ?>";
        var data = {
            car_id: car_id,
            driver_id: driver_id
        };

        $.post(url, data, function (result) {
            $("#dialog_driver").modal("hide");
            get_map_truck();
        });
    }
</script>
