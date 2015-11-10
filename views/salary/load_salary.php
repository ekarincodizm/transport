<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>ปี</th>
            <th>เดือน</th>
            <th>เงินเดือน</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($salary as $rs):
            ?>
            <tr>
                <td>#</td>
                <td><?php echo $rs['year'] ?></td>
                <td><?php echo $rs['month'] ?></td>
                <td><?php echo $rs['salary'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

