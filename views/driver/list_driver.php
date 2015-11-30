
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
        <?php $i = 0;
        foreach ($driver as $rs): $i++;
            //$order_id = $order->find()->where(['order_id' => $rs['order_id']])->one()['id'];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td>
                    <?php if(!empty($rs['images'])){ ?>
                    <img src="<?php echo Url::to('@web/web/uploads/profile/'.$rs['images']); ?>" width="30px;"/>
                    <?php } else {?>
                    <img src="<?php echo Url::to('@web/web/images/No_image.jpg'); ?>" style=" max-height: 50px; max-width: 30px;"/>
                    <?php } ?>
                </td>
                <td>
                    <?php echo $rs['name'].' - '.$rs['lname'] ?>
                </td>
                <td style=" text-align: center;">
                    <a href="<?php echo Url::to(['driver/view','id' => $rs['id']])?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-user"></i></button></a>
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
            "scrollY" : "250px"
        });
    });
</script>
