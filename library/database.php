 <?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../config/config.php');
?>

<?php
    class Database 
    {
        public $host = DB_HOST;
        public $user = DB_USER;
        public $pass = DB_PASS;
        public $dbname = DB_NAME;
        
        public $link;
        public $error;
        
        public function __construct() {
            $this->connectDB();
        }
        
        private function connectDB() {
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if(!$this->link) {
                $this->error = "Connect fail ".$this->link->connect->error;
                return false;
            }
        }
        
        //Select data
        public function select($query) {
            $result = $this->link->query($query) or die($this->link->error.__LINE__);
            if($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }
        
        //Insert data
        public function insert($query) {
            $insert_now = $this->link->query($query) or die($this->link->error.__LINE__);
            if($insert_now) {
                return $insert_now;
            } else {
                return false;
            }
        }
        
        //Update data
        public function update($query) {
            $update_now = $this->link->query($query) or die($this->link->error.__LINE__);
            if($update_now) {
                return $update_now;
            } else {
                return false;
            }
        }
        
        //Delete data
        public function delete($query) {
            $delete_now = $this->link->query($query) or die($this->link->error.__LINE__);
            if($delete_now) {
                return $delete_now;
            } else {
                return false;
            }
        }
    }
?>

