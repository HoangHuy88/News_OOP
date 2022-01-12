<?php
    include_once './inc/header.php';
    include_once './classes/client.php';
?>
<?php
    $client = new client();
    
    if(isset($_GET['key_search']) && $_GET['key_search'] != '') {
        $key = $_GET['key_search'];
        
        //Xu ly tu khoa
        $new_key = trim($key);
        $arr_new_key = explode(' ', $new_key);
        $new_key = implode('%', $arr_new_key);
        $new_key = '%'.$new_key.'%';   
    }
?>
<div class="main-news">
    <div class="container" style="margin-top: 28px;">
        <div class="row">
            <div class="col-lg-9">
                <h2 style="border-bottom: 3px double #000; padding-bottom: 15px;">Từ khóa: <?php echo $key; ?></h2>
                <?php
                    $show_news_search = $client->show_news_search($new_key);
                    if($show_news_search) {
                        while($value = $show_news_search->fetch_assoc()) {                   
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