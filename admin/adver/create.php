<?php
    include '../classes/adver.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm quảng cáo</h1>
</div>
<?php
    $adver = new advertisement();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertAdver = $adver->insert_adver($_POST, $_FILES);
    }
    
    if(isset($insertAdver)) {
        echo $insertAdver;
    }
?>
<!-- Content Row -->
<form method="POST" action="?page=add-advertisement" enctype="multipart/form-data">   
    <div class="form-group">
        <label for="exampleFormControlFile1">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
    </div>
    <div class="form-group">
        <label for="">Trạng thái</label>
        <select class="form-control" name="action">
            <option value="1">Kích hoạt</option>
            <option value="0">Không kích hoạt</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Ngày bắt đầu</label>
        <input type="date" name="start_date" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Ngày kết thúc</label>
        <input type="date" name="end_date" class="form-control">
    </div>
    
    <button type="submit" name="submit" class="btn btn-dark">Thêm quảng cáo</button>
</form>