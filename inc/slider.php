<?php
    include_once './classes/client.php';
    $client = new client();
?>
<div class="top-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6 tn-left">
                <div class="row tn-slider">
                    <?php
                        $show_news_hot = $client->slide_show1_news();
                        if($show_news_hot) {
                            while($result_1 = $show_news_hot->fetch_assoc()) {
                        
                    ?>
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img src="img/news/<?php echo $result_1['image']; ?>" />
                            <div class="tn-title">
                                <a href="detail_news.php?slug=<?php echo $result_1['slug_news']; ?>"><?php echo mb_substr($result_1['title'], 0, 50).'...'; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-6 tn-right">
                <div class="row">
                    <?php
                        $show_news = $client->slide_show2_news();
                        if($show_news) {
                            while($result_2 = $show_news->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img src="img/news/<?php echo $result_2['image']; ?>" height="180"/>
                            <div class="tn-title">
                                <a href="detail_news.php?slug=<?php echo $result_2['slug_news']; ?>"><?php echo mb_substr($result_2['title'], 0, 50).'...'; ?></a>
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
<!-- Top News End-->