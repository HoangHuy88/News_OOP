<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../library/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class news 
    {      
        private $db;
        private $fm;
                
        function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function select_news() {
            $news_trang = 4;
            if(!isset($_GET['trang'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang-1)*$news_trang;
            
            $query = "SELECT news.*, category.name FROM news INNER JOIN category WHERE news.id_cate = category.id "
                    . "ORDER BY id DESC LIMIT $tung_trang, $news_trang";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function get_all_news() {
            $query = "SELECT * FROM news";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_news($data, $files) {
            $title = mysqli_real_escape_string($this->db->link, $data['title']);
            $slug = $data['news_slug'];
            $type = $data['type'];
            $tac_gia = mysqli_real_escape_string($this->db->link, $data['tac_gia']);
            $tom_tat = mysqli_real_escape_string($this->db->link, $data['tom_tat']);
            $noi_dung = mysqli_real_escape_string($this->db->link, $data['noi_dung']);
            $id_cate = mysqli_real_escape_string($this->db->link, $data['id_cate']);
            
            //Check image
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image = "../img/news/".$unique_image;
            
            if($title == '' || $tac_gia == '' || $file_name == '' || $tom_tat == '' 
                    || $noi_dung == '' || $id_cate == '') {
                $alert = "<p class='text-danger'>Vui lòng nhập đầy đủ thông tin!!</p>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $upload_image);
                $query = "INSERT INTO news(title, slug_news, type, tac_gia, image, tom_tat, noi_dung, created_at, id_cate) "
                        . "VALUES ('$title', '$slug', '$type', '$tac_gia', '$unique_image', '$tom_tat', '$noi_dung', now(), '$id_cate')";
                $result = $this->db->insert($query);
                
                if($result) {
                    $alert = "<p class='text-primary'>Thêm tin tức thành công!!</p>";
                    return $alert;
                } else {
                    $alert = "<p class='text-danger'>Thêm tin tức không thành công!!</p>";
                    return $alert;
                }
            }
        }
        
        public function update_news($data, $files, $id) {
            $title = mysqli_real_escape_string($this->db->link, $data['title']);
            $slug = $data['news_slug'];
            $type = $data['type'];
            $tac_gia = mysqli_real_escape_string($this->db->link, $data['tac_gia']);
            $tom_tat = mysqli_real_escape_string($this->db->link, $data['tom_tat']);
            $noi_dung = mysqli_real_escape_string($this->db->link, $data['noi_dung']);
            $id_cate = mysqli_real_escape_string($this->db->link, $data['id_cate']);
            
            //Check image
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image = "../img/news/".$unique_image;
            
            if($title == '' || $tac_gia == '' || $tom_tat == '' 
                    || $noi_dung == '' || $id_cate == '') {
                $alert = "<p class='text-danger'>Vui lòng nhập đầy đủ thông tin!!</p>";
                return $alert;
            } else {
                if(!empty($file_name)) {
                    //Nguoi dung chon anh moi
                    if(in_array($file_ext, $permited) === false) {
                        $alert = "<p class='text-danger'>File ảnh là file: ". implode(', ', $permited)."</p>";
                        return $alert;
                    }
                    
                    move_uploaded_file($file_temp, $upload_image);
                    
                    $query = "UPDATE news SET title='$title', slug_news='$slug', type='$type', tac_gia='$tac_gia', "
                            . "image='$unique_image', tom_tat='$tom_tat',noi_dung='$noi_dung', "
                            . "id_cate='$id_cate' WHERE id='$id'";
                    $result = $this->db->insert($query);
                } else {
                    //Nguoi dung khong chon anh moi
                    $query = "UPDATE news SET title='$title', slug_news='$slug', type='$type', tac_gia='$tac_gia', "
                            . "tom_tat='$tom_tat',noi_dung='$noi_dung', id_cate='$id_cate' WHERE id='$id'";
                    $result = $this->db->insert($query);                
                }
                
                if($result) {
                    $alert = "<p class='text-primary'>Cập nhật tin tức thành công!!</p>";
                    return $alert;
                } else {
                    $alert = "<p class='text-danger'>Cập nhật tin tức không thành công!!</p>";
                    return $alert;
                }
            }
        }
        
        public function delete_news($id) {
            $query = "DELETE FROM news WHERE id='$id' LIMIT 1";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<p class='text-primary'>Xóa tin tức thành công!!</p>";
                return $alert;
            } else {
                $alert = "<p class='text-danger'>Xóa tin tức không thành công!!</p>";
                return $alert;
            }
        }

        public function getnewsbyId($id) {
            $query = "SELECT * FROM news WHERE id='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
}
?>
