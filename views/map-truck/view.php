<?php 
    use yii\helpers\Url;
?>
<table class="table table-striped table-bordered" id="tb_map_truck">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align: center;">คันที่</th>
            <th>หัวลาก</th>
            <th>พ่วง</th>
            <th style="text-align: center;">คนขับประจำ</th>
            <th style="text-align: center;">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($car as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo $rs['car_id']; ?></td>
                <td><?php echo $rs['truck_1']; ?></td>
                <td><?php echo $rs['truck_2']; ?></td>
                <td>
                    <?php if (!empty($rs['driver'])) { ?>
                        <?php echo $rs['name'] . ' ' . $rs['lname']; ?>
                    <button type="button" class="btn btn-warning btn-xs pull-right"
                            onclick="dialog_driver('<?php echo $rs['car_id']; ?>')"><i class="fa fa-exchange"></i></button>
                    <?php } else { ?>
                        <div style="color: #ff0000;">
                            ไม่ได้เลือกคนขับ 
                            <button type="button" class="btn btn-default btn-sm pull-right" style=" padding: 0px 5px;"
                                    onclick="dialog_driver('<?php echo $rs['car_id']; ?>')"><i class="fa fa-user-plus text-green"></i></button>
                        </div>
                    <?php } ?>
                </td>
                <td style="text-align: center;">
                    <a href="<?php echo Url::to(['map-truck/detail','car_id' => $rs['car_id']])?>"><i class="fa fa-eye"></i></a>&nbsp;
                    <a href="<?php echo Url::to(['map-truck/update','car_id' => $rs['car_id']])?>"><i class="fa fa-edit"></i></a>&nbsp;
                    <a href="<?php echo Url::to(['map-truck/delete','car_id' => $rs['car_id']])?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

