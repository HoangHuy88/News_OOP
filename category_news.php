<?php
    include_once './inc/header.php';
    include_once './classes/client.php';
?>
<?php
    $client = new client();
    
    if(isset($_GET['slug'])) {
        $slug_cate = $_GET['slug'];
        
        $show_cate = $client->show_cate($slug_cate);
        if($show_cate) {
            $result = $show_cate->fetch_assoc();
            $id_cate = $result['id'];
            $name_cate = $result['name'];
        }      
    }
?>
<div class="main-news">
    <div class="container" style="margin-top: 28px;">
        <div class="row">
            <div class="col-lg-9">
                <h2 style="border-bottom: 3px double #000; padding-bottom: 15px;"><?php echo $name_cate; ?></h2>
                <?php
                    $show_news = $client->show_news($id_cate);
                    if($show_news) {
                        while($value = $show_news->fetch_assoc()) {                   
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mn-img">
                            <img src="img/news/<?php echo $value['image']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <a href="detail_news.php?slug=<?php echo $value['slug_news']; ?>" style="font-size: 18px; font-weight: 550;">
                            <?php
                                echo $value['title'];
                            ?>
                        </a>
                        <p style="font-size: 14px;">Lượt xem: <span style="font-weight: 600;"><?php echo $value['views']; ?></span></p>
                        <p>
                            <?php
                                echo $value['tom_tat'];
                            ?>
                        </p>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
                <hr>
                
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                            $news_all = $client->show_all_news($id_cate);
                            $news_count = mysqli_num_rows($news_all);
                            $product_button = ceil($news_count/4);
                            $i = 1;
                            
                            for($i = 1; $i <= $product_button; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="category_news.php?slug='.$slug_cate.'&trang='.$i.'">'.$i.'</a></li>';
                            }
                        ?>                       
                    </ul>
                </nav>
            </div>  

            <div class="col-lg-3">
                <div class="mn-list">
                    <h2>Tin hot</h2>
                    <ul>
                        <?php
                            $show_news_hot = $client->show_news_hot();
                            if($show_news_hot) {
                                while($row = $show_news_hot->fetch_assoc()) {                            
                        ?>
                        <li><a href="detail_news.php?slug=<?php echo $row['slug_news']; ?>"><?php echo $row['title']; ?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once './inc/footer.php';
?>