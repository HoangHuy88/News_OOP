<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../library/database.php');
?>

<?php
    class client 
    {      
        private $db;
                
        function __construct() {
            $this->db = new Database();
        }
        
        public function select_cate() {
            $query = "SELECT * FROM category ORDER BY id ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function slide_show1_news() {
            $query = "SELECT * FROM news WHERE type=2 ORDER BY id DESC LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function slide_show2_news() {
            $query = "SELECT * FROM news ORDER BY id DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_business() {
            $query = "SELECT * FROM news WHERE id_cate=3 ORDER BY id DESC LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_technolory() {
            $query = "SELECT * FROM news WHERE id_cate=4 ORDER BY id DESC LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_sport() {
            $query = "SELECT * FROM news WHERE id_cate=5 ORDER BY id DESC LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_entertain() {
            $query = "SELECT * FROM news WHERE id_cate=7 ORDER BY id DESC LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_news_view() {
            $query = "SELECT * FROM news ORDER BY views DESC LIMIT 6";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_news_index() {
            $query = "SELECT * FROM news ORDER BY id DESC LIMIT 6";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_adver() {
            $query = "SELECT * FROM advertisement WHERE action=1 ORDER BY id DESC LIMIT 2";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_cate($slug) {
            $query = "SELECT * FROM category WHERE slug='$slug' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_news($id_cate) {
            $news_trang = 4;
            if(!isset($_GET['trang'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang-1)*$news_trang;
            
            $query = "SELECT * FROM news WHERE id_cate='$id_cate' ORDER BY id DESC LIMIT $tung_trang,$news_trang";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_all_news($id_cate) {
            $query = "SELECT * FROM news WHERE id_cate='$id_cate'";
            $result = $this->db->select($query);
            return $result;
        }


        public function show_news_hot() {
            $query = "SELECT * FROM news WHERE type=2 ORDER BY id DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }


        public function detail_show_news($slug) {
            $query = "SELECT * FROM news WHERE slug_news='$slug' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_view($slug_news) {
            $query = "UPDATE news SET views=views+1 WHERE slug_news='$slug_news'";
            $result = $this->db->update($query);
            return $result;
        }
        
        public function show_same_cate($slug) {
            $query = "SELECT * FROM news WHERE slug_news='$slug' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_same_news($id_cate, $slug) {
            $query = "SELECT * FROM news WHERE id_cate='$id_cate' AND slug_news != '$slug' ORDER BY id DESC LIMIT 6";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function show_news_search($key) {
            $query = "SELECT * FROM news WHERE title LIKE ('$key') OR tom_tat LIKE ('$key') ORDER BY id DESC LIMIT 6";
            $result = $this->db->select($query);
            return $result;
        }
}
?>
