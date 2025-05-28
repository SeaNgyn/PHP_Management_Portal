<?php include '../layouts/header.php'; ?>

<div id="divMain" class="row row2">
    <div class="col-sm-2 sidebar" style="background-color:#2e43d1;padding-right: 0">
        <?php include '../layouts/sidebar.php'; ?>
    </div>
    <div class="col-sm-10 content" style="background-color:rgb(252, 252, 252);">
        <div id="modTitle" class="module-title" style="height:25px;margin-left:-15px;">Giảng dạy</div>
        <?php include '../layouts/dash.php'; ?>
        <!-- Phân trang -->
        <div style="text-align: center;">

            <?php
            // $sql_trang = mysqli_query($statement,"SELECT * FROM ma_lop_hp");
            $sql = "SELECT * from giang_vien gv 
             join giangvien_malophp gvmlhp on gv.id = gvmlhp.giang_vien_id 
            join ma_lop_hp mlhp on mlhp.id = gvmlhp.id_ma_lop_hp 
            join mon_hoc mh on mlhp.id_mon_hoc = mh.id where gvmlhp.giang_vien_id = 68";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $monhocs = $statement->fetchAll();
            $row_count = count($monhocs);
            $trang = ceil($row_count / 10);
            ?>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $trang; $i++) {
                ?>
                <li><a href="dashboard.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                <!-- <li class="disabled"><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li> -->

                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<script src="../../js/dash.js"></script>