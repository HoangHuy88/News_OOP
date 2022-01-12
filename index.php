<?php include_once './inc/header.php'?>
<?php include_once './inc/slider.php'; ?>
<?php include_once './classes/client.php'; ?>
<?php
    $client = new client();
?>
<!-- Category News Start-->
<div class="cat-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Kinh doanh</h2>
                <div class="row cn-slider">
                    <?php
                        $show_business = $client->show_business();
                        if($show_business) {
                            while($value_bus = $show_business->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="cn-img">
                            <img src="img/news/<?php echo $value_bus['image']; ?>" />
                            <div class="cn-title">
                                <a href="detail_news.php?slug=<?php echo $value_bus['slug_news']; ?>">
                                    <?php echo mb_substr($value_bus['title'], 0, 30).'...'; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Công nghệ</h2>
                <div class="row cn-slider">
                    <?php
                        $show_technolory = $client->show_technolory();
                        if($show_technolory) {
                            while($value_tech = $show_technolory->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="cn-img">
                            <img src="img/news/<?php echo $value_tech['image']; ?>" />
                            <div class="cn-title">
                                <a href="detail_news.php?slug=<?php echo $value_tech['slug_news']; ?>">
                                    <?php echo mb_substr($value_tech['title'], 0, 30).'...'; ?>
                                </a>
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
    </div>
</div>
<!-- Category News End-->

<!-- Category News Start-->
<div class="cat-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Thể thao</h2>
                <div class="row cn-slider">
                    <?php
                        $show_sport = $client->show_sport();
                        if($show_sport) {
                            while($value_sport = $show_sport->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="cn-img">
                            <img src="img/news/<?php echo $value_sport['image']; ?>" />
                            <div class="cn-title">
                                <a href="detail_news.php?slug=<?php echo $value_sport['slug_news']; ?>">
                                    <?php echo mb_substr($value_sport['title'], 0, 30).'...'; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Giải trí</h2>
                <div class="row cn-slider">
                    <?php
                        $show_enter = $client->show_entertain();
                        if($show_enter) {
                            while($value_enter = $show_enter->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="cn-img">
                            <img src="img/news/<?php echo $value_enter['image']; ?>" height="170"/>
                            <div class="cn-title">
                                <a href="detail_news.php?slug=<?php echo $value_enter['slug_news']; ?>">
                                    <?php echo mb_substr($value_enter['title'], 0, 30).'...'; ?>
                                </a>
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
    </div>
</div>
<!-- Category News End-->

<!-- Main News Start-->
<div class="main-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <h2 style="border-bottom: 3px double #000; padding-bottom: 15px;">Xem nhiều</h2>
                <?php
                    $show_news_view = $client->show_news_view();
                    
                    if($show_news_view) {
                        while($result = $show_news_view->fetch_assoc()) {
                    
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mn-img">
                            <img src="img/news/<?php echo $result['image']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <a href="detail_news.php?slug=<?php echo $result['slug_news']; ?>" style="font-size: 18px; font-weight: 550;">
                            <?php echo $result['title']; ?>
                        </a>
                        <p style="font-size: 14px;">Lượt xem: <span style="font-weight: 600;"><?php echo $result['views']; ?></span></p>
                        <p>
                            <?php echo $result['tom_tat']; ?>
                        </p>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>

            <div class="col-lg-3">
                <div class="mn-list">
                    <h2>Đọc thêm</h2>
                    <ul>
                        <?php
                            $show_news_index = $client->show_news_index();
                            if($show_news_index) {
                                while($value = $show_news_index->fetch_assoc()) {
                            
                        ?>
                        <li><a href="detail_news.php?slug=<?php echo $value['slug_news']; ?>"><?php echo mb_substr($value['title'], 0, 40).'...'; ?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div>
                    <?php
                        $show_adver = $client->show_adver();
                        if($show_adver) {
                            while($row = $show_adver->fetch_assoc()) {
                        
                    ?>
                    <img src="img/advertisement/<?php echo $row['image']; ?>" width="100%" height="480"/>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main News End-->
<?php
include_once './inc/footer.php';
?>