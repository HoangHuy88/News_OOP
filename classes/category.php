<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../library/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class category 
    {      
        private $db;
        private $fm;
                
        function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function select_cate() {
            $cate_trang = 4;
            
            if(!isset($_GET['trang'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang'];
            }
            
            $tung_trang = ($trang-1)*$cate_trang;
            
            $query = "SELECT * FROM category ORDER BY id DESC LIMIT $tung_trang,$cate_trang";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function get_all_cate() {
            $query = "SELECT * FROM category";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_cate($name, $slug) {
            $name = $this->fm->validation($name);
            $slug = $this->fm->validation($slug);
            
            $name = mysqli_real_escape_string($this->db->link, $name);
            $slug = mysqli_real_escape_string($this->db->link, $slug);
            
            if(empty($name)) {
                $alert = "<p class='text-danger'>Vui lòng nhập vào danh mục tin!!</p>";
                return $alert;
            } else {
                $query = "INSERT INTO category (name, slug, created_at) VALUES ('$name', '$slug', now())";
                $result = $this->db->insert($query);
                
                if($result) {
                    $alert = "<p class='text-primary'>Thêm danh mục tin thành công!!</p>";
                    return $alert;
                } else {
                    $alert = "<p class='text-danger'>Thêm danh mục tin không thành công!!</p>";
                    return $alert;
                }
            }
        }
        
        public function update_cate($name, $slug, $id) {
            $name = $this->fm->validation($name);
            $slug = $this->fm->validation($slug);
            
            $name = mysqli_real_escape_string($this->db->link, $name);
            $slug = mysqli_real_escape_string($this->db->link, $slug);
            
            if(empty($name)) {
                $alert = "<p class='text-danger'>Vui lòng nhập vào danh mục tin!!</p>";
                return $alert;
            } else {
                $query = "UPDATE category SET name='$name',slug='$slug' WHERE id='$id'";
                $result = $this->db->update($query);
                
                if($result) {
                    $alert = "<p class='text-primary'>Cập nhật danh mục tin thành công!!</p>";
                    return $alert;
                } else {
                    $alert = "<p class='text-danger'>Cập nhật danh mục tin không thành công!!</p>";
                    return $alert;
                }
            }
        }
        
        public function delete_cate($id) {
            $query = "DELETE FROM category WHERE id='$id' LIMIT 1";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<p class='text-primary'>Xóa danh mục tin thành công!!</p>";
                return $alert;
            } else {
                $alert = "<p class='text-danger'>Xóa danh mục tin không thành công!!</p>";
                return $alert;
            }
        }

        public function getcatebyId($id) {
            $query = "SELECT * FROM category WHERE id='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
}
?>
