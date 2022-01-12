<?php
    include_once './inc/header.php';
    include_once './classes/client.php';
?>
<?php
    $client = new client();
    if(isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];
        
        $show_same_news = $client->show_same_cate($slug);
        if($show_same_news) {
            $value_cate = $show_same_news->fetch_assoc();
            $id_cate = $value_cate['id_cate'];
        }
        
        $update_view = $client->update_view($slug);
      
        $show_news_detail = $client->detail_show_news($slug);
        if($show_news_detail) {
            $result = $show_news_detail->fetch_assoc();
        }
    } 
?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="">Tin tức</a></li>
            <li class="breadcrumb-item active">Chi tiết tin</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Single News Start-->
<div class="single-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="sn-container">
                    <div class="sn-img">
                        <img src="img/news/<?php echo $result['image']; ?>" width="100%" height="400"/>
                    </div>
                    <div class="sn-content">
                        <h3 class="sn-title"><?php echo $result['title']; ?></h3>
                        <p style="width: 100%;">
                            <?php
                                echo $result['noi_dung'];
                            ?>
                        </p>
                    </div>
                </div>
                <div class="sn-related">
                    <h2>Tin mới nhất</h2>
                    <div class="row sn-slider">
                        <?php
                            $show_news = $client->slide_show2_news();
                            if($show_news) {
                                while($value = $show_news->fetch_assoc()) {
                        ?>
                        <div class="col-md-4">
                            <div class="sn-img">
                                <img src="img/news/<?php echo $value['image']; ?>" height="150"/>
                                <div class="sn-title">
                                    <a href="detail_news.php?slug=<?php echo $value['slug_news']; ?>"><?php echo mb_substr($value['title'], 0, 30).'...'; ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="sidebar-widget">
                        <h2 class="sw-title">Tin cùng danh mục</h2>
                        <div class="news-list">
                            <?php
                                $show_news_same_cate = $client->show_same_news($id_cate, $slug);
                                if($show_news_same_cate) {
                                    while($value_news = $show_news_same_cate->fetch_assoc()) {
                            ?>
                            <div class="nl-item">
                                <div class="nl-img">
                                    <img src="img/news/<?php echo $value_news['image']; ?>" />
                                </div>
                                <div class="nl-title">
                                    <a href="detail_news.php?slug=<?php echo $value_news['slug_news']; ?>"><?php echo $value_news['title']; ?></a>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="sidebar-widget">
                        <h2 class="sw-title">Tags Cloud</h2>
                        <div class="tags">
                            <a href="">Tin moi nhat</a>
                            <a href="">Tin cong nghe</a>
                            <a href="">Tin trong nuoc</a>
                            <a href="">Tin quoc te</a>
                            <a href="">Tin the thao</a>
                            <a href="">Tin giai tri</a>
                        </div>
                    </div>
                    
                    <div>
                        <?php
                            $show_adver = $client->show_adver();
                            if($show_adver) {
                                while($row = $show_adver->fetch_assoc()) {

                        ?>
                        <img src="img/advertisement/<?php echo $row['image']; ?>" width="80%" height="480"/>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single News End-->        
<?php
include_once './inc/footer.php';
?>