<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */

$this->title = "แจ้งเตือนเปลี่ยนถ่ายน้ำมันเครื่อง";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-tint"></i> แจ้งเตือนเปลี่ยนถ่ายน้ำมันเครื่อง
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>เลขไมล์เปลี่ยนน้ำมันล่าสุด</th>
                    <th>เลขไมล์ที่ถึงกำหนดเปลี่ยน</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
<?php
$i = 0;
foreach ($result as $rs): $i++;
    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rs['last_mile'] ?></td>
                        <td><?php echo $rs['next_mile'] ?></td>
                        <td>
    <?php
    if (substr($rs['mile_over'], 0, 1) == '-') {
        echo "<p style='color:red;'>เกินกำหนด" . ($rs['mile_over']) . "</p> ";
    } else {
        echo "<p style='color:orange;'>ใกล้ถึงกำหนด</p> ";
    }
    ?>
                        </td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>