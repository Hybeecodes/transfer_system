<?php  
include 'app/init.php';
$admin = new Admin($db_conn);

var_dump($admin->get_faculties());



?>