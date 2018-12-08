<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 3:50 PM
 */
include 'app/init.php';
$admin = new Admin($db_conn);

if(isset($_POST['admin_login'])){
    if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $response = $admin->admin_login($email,$password);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Please, Fill all fields!"));
    }
    exit($response);
}