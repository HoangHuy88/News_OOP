<?php include '../classes/category.php'; ?>
<?php include '../classes/news.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm tin tức</h1>
</div>
<!-- Content Row -->
<?php 
    $addNews = new news();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertNews = $addNews->insert_news($_POST, $_FILES);
    }
    
    if(isset($insertNews)) {
        echo $insertNews;
    }
?>
<form method="POST" action="?page=add-news" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" name="title" onkeyup="ChangeToSlug();" id="slug" class="form-control" placeholder="Tên danh mục tin tức">
    </div>
    <div class="form-group">
        <label for="">Slug tin tức</label>
        <input type="text" name="news_slug" id="convert_slug" class="form-control" placeholder="Slug danh mục tin tức" readonly="">
    </div>
    <div class="form-group">
        <label for="">Loại tin</label>
        <select class="form-control" name="type">
            <option value="1">Tin thường</option>
            <option value="2">Tin hot</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Tác giả</label>
        <input type="text" name="tac_gia" class="form-control" placeholder="Tên tác giả">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
    </div>
    <div class="form-group">
        <label for="">Tóm tắt</label>
        <textarea name="tom_tat" class="form-control" cols="30" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="">Nội dung</label>
        <textarea name="noi_dung" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="">Danh mục tin</label>
        <select class="form-control" name="id_cate">
            <option selected="">----Chọn danh mục tin----</option>
            <?php
                $cate = new category();
                $catelist = $cate->get_all_cate();
                if($catelist) {
                    while($result = $catelist->fetch_assoc()) {
                
            ?>
                <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
            <?php
                    }
                }
            ?>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-dark mb-4">Thêm tin tức</button>
</form>