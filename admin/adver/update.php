<?php
    include '../classes/adver.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật quảng cáo</h1>
</div>
<?php
    if(!isset($_GET['adverid']) || $_GET['adverid'] == NULL) {
        echo "<script>window.location = '?page=advertisement'</script>";
    } else {
        $id = $_GET['adverid'];
    }
    
    $adver = new advertisement();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateAdver = $adver->update_adver($_POST, $_FILES, $id);
    }
    
    if(isset($updateAdver)) {
        echo $updateAdver;
    }
    
    $getAdver = $adver->getadverbyId($id);
    if($getAdver) {
        $result = $getAdver->fetch_assoc();
    }
?>
<!-- Content Row -->
<form method="POST" action="" enctype="multipart/form-data">   
    <div class="form-group">
        <label for="exampleFormControlFile1">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file"> <br>
        <img src="../img/advertisement/<?php echo $result['image']; ?>" width="120" height="180"/>
    </div>
    <div class="form-group">
        <label for="">Trạng thái</label>
        <select class="form-control" name="action">
            <?php
                if($result['action'] == 1) {
            ?>
            <option selected="" value="1">Kích hoạt</option>
            <option value="0">Không kích hoạt</option>
            <?php
                } else {
            ?>
            <option value="1">Kích hoạt</option>
            <option selected="" value="0">Không kích hoạt</option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Ngày bắt đầu</label>
        <input type="date" name="start_date" class="form-control" value="<?php echo $result['start_date']; ?>">
    </div>
    <div class="form-group">
        <label for="">Ngày kết thúc</label>
        <input type="date" name="end_date" class="form-control" value="<?php echo $result['end_date']; ?>">
    </div>
    
    <button type="submit" name="submit" class="btn btn-dark">Cập nhật quảng cáo</button>
</form>