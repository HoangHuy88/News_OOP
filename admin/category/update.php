<?php
    include '../classes/category.php';
?>
<?php
    if(!isset($_GET['cateid']) || $_GET['cateid'] == NULL) {
        echo "<script>window.location = '?page=category'</script>";
    } else {
        $id = $_GET['cateid'];
    }
    
    $cate = new category();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['cate_name'];
        $slug = $_POST['cate_slug'];
        
        $updateCate = $cate->update_cate($name, $slug, $id);
    }
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật danh mục tin</h1>
</div>
<?php
    if(isset($updateCate)) {
        echo $updateCate;
    }
    
    $getName = $cate->getcatebyId($id);
    if($getName) {
        $result = $getName->fetch_assoc();
    }
    
?>
<!-- Content Row -->
<form method="POST" action="">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" name="cate_name" onkeyup="ChangeToSlug();" id="slug" class="form-control" value="<?php echo $result['name']; ?>">
    </div>
    <div class="form-group">
        <label for="">Slug danh mục</label>
        <input type="text" name="cate_slug" id="convert_slug" class="form-control" value="<?php echo $result['slug']; ?>" readonly="">
    </div>
    <button type="submit" name="update_cate" class="btn btn-dark">Cập nhật danh mục</button>
</form>