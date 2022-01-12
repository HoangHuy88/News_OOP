<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../library/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class advertisement 
    {      
        private $db;
        private $fm;
                
        function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function select_adver() {
            $query = "SELECT * FROM advertisement ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_adver($data, $files) {
            $action = $data['action'];
            $start_date = mysqli_real_escape_string($this->db->link, $data['start_date']);
            $end_date = mysqli_real_escape_string($this->db->link, $data['end_date']);
            
            //Check image
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image = "../img/advertisement/".$unique_image;
            
            if($start_date == '' || $end_date == '' || $file_name == '') {
                $alert = "<p class='text-danger'>Vui lòng nhập đầy đủ thông tin!!</p>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $upload_image);
                $query = "INSERT INTO advertisement (image, action, start_date, end_date) VALUES ('$unique_image', '$action', '$start_date', '$end_date')";
                $result = $this->db->insert($query);
                
                if($result) {
                    $alert = "<p class='text-primary'>Thêm quảng cáo thành công!!</p>";
                    return $alert;
                } else {
                    $alert = "<p class='text-danger'>Thêm quảng cáo không thành công!!</p>";
                    return $alert;
                }
            }
        }
        
        public function update_adver($data, $files, $id) {
            $start_date = mysqli_real_escape_string($this->db->link, $data['start_date']);
            $end_date = mysqli_real_escape_string($this->db->link, $data['end_date']);
            $action = $data['action'];
            
            //Check image
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image = "../img/advertisement/".$unique_image;
            
            if($start_date == '' || $end_date == '') {
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
                    
                    $query = "UPDATE advertisement SET image='$unique_image', action='$action', "
                            . "start_date='$start_date', end_date='$end_date' WHERE id='$id'";
                    $result = $this->db->insert($query);
                } else {
                    //Nguoi dung khong chon anh moi
                    $query = "UPDATE advertisement SET action='$action', "
                            . "start_date='$start_date', end_date='$end_date' WHERE id='$id'";
                    $result = $this->db->insert($query);                  
                }
                
                if($result) {
                    $alert = "<p class='text-primary'>Cập nhật quảng cáo thành công!!</p>";
                    return $alert;
                } else {
                    $alert = "<p class='text-danger'>Cập nhật quảng cáo không thành công!!</p>";
                    return $alert;
                }
            }
        }
        
        public function delete_adver($id) {
            $query = "DELETE FROM advertisement WHERE id='$id' LIMIT 1";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<p class='text-primary'>Xóa quảng cáo thành công!!</p>";
                return $alert;
            } else {
                $alert = "<p class='text-danger'>Xóa quảng cáo không thành công!!</p>";
                return $alert;
            }
        }

        public function getadverbyId($id) {
            $query = "SELECT * FROM advertisement WHERE id='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
}
?>
