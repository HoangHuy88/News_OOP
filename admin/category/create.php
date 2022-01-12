<?php
    include '../classes/category.php';
?>
<?php
    $cate = new category();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['cate_name'];
        $slug = $_POST['cate_slug'];
        
        $insertCate = $cate->insert_cate($name, $slug);
    }
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm danh mục tin</h1>
</div>
<?php
    if(isset($insertCate)) {
        echo $insertCate;
    }
?>
<!-- Content Row -->
<form method="POST" action="?page=add-category">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" name="cate_name" onkeyup="ChangeToSlug();" id="slug" class="form-control" placeholder="Tên danh mục tin tức">
    </div>
    <div class="form-group">
        <label for="">Slug danh mục</label>
        <input type="text" name="cate_slug" id="convert_slug" class="form-control" placeholder="Slug danh mục tin tức" readonly="">
    </div>
    <button type="submit" name="add_cate" class="btn btn-dark">Thêm danh mục</button>
</form>