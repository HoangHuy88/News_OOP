<?php
    include '../classes/adver.php';
?>
<?php
    $adver = new advertisement();
    
    if(isset($_GET['delid'])) {
        $id = $_GET['delid'];
        
        $deleteAdver = $adver->delete_adver($id);
    }
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Danh sách quảng cáo</h1>
    <a href="?page=add-advertisement" class="btn btn-dark">Thêm quảng cáo</a>
</div>
<?php
    if(isset($deleteAdver)) {
        echo $deleteAdver;
    }
?>
<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày bắt đầu</th>
            <th scope="col">Ngày kết thúc</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php           
            $show_adver = $adver->select_adver();
            if($show_adver) {    
                $i = 1;
                while ($result = $show_adver->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td>
                <img src="../img/advertisement/<?php echo $result['image']; ?>" width="100" height="200"/>
            </td>
            <?php
                if($result['action'] == 1) {
                    echo '<td class="text-primary">Hiển thị</td>';
                } else {
                    echo '<td class="text-danger">Không hiển thị</td>';
                }
            ?>
            <td><?php echo $result['start_date']; ?></td>
            <td><?php echo $result['end_date']; ?></td>
            <td>
                <a href="?page=update-advertisement&adverid=<?php echo $result['id']; ?>" class="btn btn-primary">Cập nhật</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa quảng cáo này không?')" 
                   href="?page=advertisement&delid=<?php echo $result['id']; ?>" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>