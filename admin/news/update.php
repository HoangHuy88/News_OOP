<?php include '../classes/category.php'; ?>
<?php include '../classes/news.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật tin tức</h1>
</div>
<!-- Content Row -->
<?php 
    $addNews = new news();
    
    if(!isset($_GET['newsid']) || $_GET['newsid'] == NULL) {
        echo "<script>window.location = '?page=news'</script>";
    } else {
        $id = $_GET['newsid'];
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateNews = $addNews->update_news($_POST, $_FILES, $id);
    }
    
    if(isset($updateNews)) {
        echo $updateNews;
    }
    
    $getNews = $addNews->getnewsbyId($id);
    if($getNews) {
        $result = $getNews->fetch_assoc();
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" name="title" onkeyup="ChangeToSlug();" id="slug" class="form-control" value="<?php echo $result['title']; ?>">
    </div>
    <div class="form-group">
        <label for="">Slug tin tức</label>
        <input type="text" name="news_slug" id="convert_slug" class="form-control" value="<?php echo $result['slug_news']; ?>" readonly="">
    </div>
    <div class="form-group">
        <label for="">Loại tin</label>
        <select class="form-control" name="type">
            <?php
                if($result['type'] == 1) {
            ?>
                <option value="1" selected="">Tin thường</option>
                <option value="2">Tin hot</option>
            <?php
                } else {
            ?>
                <option value="1">Tin thường</option>
                <option value="2" selected="">Tin hot</option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Tác giả</label>
        <input type="text" name="tac_gia" class="form-control" value="<?php echo $result['tac_gia']; ?>">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file"> <br>
        <img src="../img/news/<?php echo $result['image']; ?>" width="160" height="100"/>
    </div>
    <div class="form-group">
        <label for="">Tóm tắt</label>
        <textarea name="tom_tat" class="form-control" cols="30" rows="4">
            <?php
                echo $result['tom_tat'];
            ?>
        </textarea>
    </div>
    <div class="form-group">
        <label for="">Nội dung</label>
        <textarea name="noi_dung" class="form-control" cols="30" rows="10">
            <?php
                echo $result['noi_dung'];
            ?>
        </textarea>
    </div>
    <div class="form-group">
        <label for="">Danh mục tin</label>
        <select class="form-control" name="id_cate">
            <option>----Chọn danh mục tin----</option>
            <?php
                $cate = new category();
                $catelist = $cate->get_all_cate();
                if($catelist) {
                    while($value = $catelist->fetch_assoc()) {
                
            ?>
                <option <?php if($result['id_cate'] == $value['id']) {echo 'selected="selected"';} ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
            <?php
                    }
                }
            ?>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-dark mb-4">Cập nhật tin tức</button>
</form>