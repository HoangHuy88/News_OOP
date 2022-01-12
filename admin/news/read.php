<?php
    include_once '../classes/news.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tin tức</h1>
    <a href="?page=add-news" class="btn btn-dark">Thêm tin tức</a>
</div>
<?php
    $readNews = new news();
    
    if(isset($_GET['delid'])) {
        $id = $_GET['delid'];
        
        $deleteNews = $readNews->delete_news($id);
    }
    
    if(isset($deleteNews)) {
        echo $deleteNews;
    }
?>
<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Loại tin</th>
            <th scope="col">Tác giả</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Thời gian</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $show_news = $readNews->select_news();
            if($show_news) {
                $i = 1;
                while ($result = $show_news->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $result['title']; ?></td>
            <?php
                if($result['type'] == 1) {
                    echo '<td class="text-primary">Tin thường</td>';
                } else {
                    echo '<td class="text-danger">Tin hot</td>';
                }
            ?>
            <td><?php echo $result['tac_gia']; ?></td>
            <td>
                <img src="../img/news/<?php echo $result['image']; ?>" width="140" height="80"/>
            </td>
            <td><?php echo $result['created_at']; ?></td>
            <td><?php echo $result['name']; ?></td>
            <td class="text-center">
                <a href="?page=update-news&newsid=<?php echo $result['id']; ?>" class="btn btn-primary">Cập nhật</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa tin này không?')" 
                   href="?page=news&delid=<?php echo $result['id']; ?>" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>
<hr>
<nav aria-label="Page navigation example">
     <ul class="pagination">
        <?php
            $news_all = $readNews->get_all_news();
            $news_count = mysqli_num_rows($news_all);
            $news_button = ceil($news_count/4);
            $i = 1;
            for($i = 1; $i <= $news_button; $i++) {
                echo '<li class="page-item"><a class="page-link" href="?page=news&trang='.$i.'">'.$i.'</a></li>';
            }
        ?>
    </ul>
</nav>