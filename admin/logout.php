<?php
    include '../library/session.php';
    Session::checkSession();
?>

<?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
    }
?>