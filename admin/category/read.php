<?php
    include '../classes/category.php';
?>
<?php
    $cate = new category();
    
    if(isset($_GET['delid'])) {
        $id = $_GET['delid'];
        
        $deleteCate = $cate->delete_cate($id);
    }
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Danh sách danh mục</h1>
    <a href="?page=add-category" class="btn btn-dark">Thêm danh mục</a>
</div>
<?php
    if(isset($deleteCate)) {
        echo $deleteCate;
    }
?>
<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Slug danh mục</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php           
            $show_cate = $cate->select_cate();
            if($show_cate) {    
                $i = 1;
                while ($result = $show_cate->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $result['name']; ?></td>
            <td><?php echo $result['slug']; ?></td>
            <td><?php echo $result['created_at']; ?></td>
            <td>
                <a href="?page=update-category&cateid=<?php echo $result['id']; ?>" class="btn btn-primary">Cập nhật</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" 
                   href="?page=category&delid=<?php echo $result['id']; ?>" class="btn btn-danger">Xóa</a>
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
            $cate_all = $cate->get_all_cate();
            $cate_count = mysqli_num_rows($cate_all);
            $cate_button = ceil($cate_count/4);
            $i = 1;
            for($i = 1; $i <= $cate_button; $i++) {
                echo '<li class="page-item"><a class="page-link" href="?page=category&trang='.$i.'">'.$i.'</a></li>';
            }
        ?>
    </ul>
</nav>