<?php
    $filepath = realpath(dirname(__FILE__));
    include ($filepath.'/../library/session.php');
    Session::checkLogin();
    include ($filepath.'/../library/database.php');
    include ($filepath.'/../helpers/format.php');
?>

<?php
    class adminlogin 
    {      
        private $db;
        private $fm;
                
        function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function login_admin($email, $pass) {
            $email = $this->fm->validation($email);
            $pass = $this->fm->validation($pass);
            
            $email = mysqli_real_escape_string($this->db->link, $email);
            $pass = mysqli_real_escape_string($this->db->link, $pass);
            
            if(empty($email) || empty($pass)) {
                $alert = "Email or Pass must be not empty";
                return $alert;
            } else {
                $query = "SELECT * FROM admin WHERE email='$email' AND pass='$pass' LIMIT 1";
                $result = $this->db->select($query);
                
                if($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set('login', true);
                    Session::set('adminId', $value['adminId']);
                    Session::set('email', $value['email']);
                    Session::set('name', $value['name']);
                    header('Location: index.php');
                } else {
                    $alert = "Email or Pass not match";
                    return $alert;
                }
            }
        }
}
?>

