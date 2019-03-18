<?php  
include '../app/init.php';

$supervisor = new Supervisor($db_conn);

function validate_field($field){
    return isset($field) && $field != '';
}

if(isset($_POST['supervisor_login'])){
    if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $response = $supervisor->login($email,$password);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Please, Fill all fields!"));
    }
    exit($response);
}

?>