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
include 'middleware/ensureLoggedIn.php';
$supervisor_id = $_SESSION['supervisor_id'];

if(isset($_POST['give_feedback'])){
    if(validate_field($_POST['title']) && validate_field($_POST['detail']) && validate_field($_POST['staff'])){
        $title = @$_POST['title'];
        $detail = @$_POST['detail'];
        $staff = @$_POST['staff'];
        $response = $supervisor->give_staff_feedback($supervisor_id,$_SESSION['supervisor_location'],$staff,$title,$detail);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Please, Fill all fields!"));
    }
    exit($response);
}

?>