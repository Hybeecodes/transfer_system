<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/18/2018
 * Time: 10:38 AM
 */

include '../app/init.php';

//
$admin = new Admin($db_conn);

function validate_field($field){
    return isset($field) && $field != '';
}

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

function getCountries(){
    global $dbc;
    //check if user exist
    $query_check = "SELECT * FROM `countries`";

    $res_check = mysqli_query($dbc,$query_check);
    $num = mysqli_num_rows($res_check);

    if($num==0){
        return false;
    }else{
        //retreive data to be used for Session data
        $countries = mysqli_fetch_all($res_check,MYSQLI_ASSOC);
        //redirect user to referer url or dashboard
        return $countries;
    }
}

function getStates($country_id){
    global $dbc;
    //check if user exist
    $query_check = "SELECT * FROM `states` WHERE `country_id` = $country_id ";

    $res_check = mysqli_query($dbc,$query_check);
    $num = mysqli_num_rows($res_check);

    if($num==0){
        return false;
    }else{
        //retreive data to be used for Session data
        $states = mysqli_fetch_all($res_check,MYSQLI_ASSOC);
        //redirect user to referer url or dashboard
        return $states;
    }
}

function getCities($state_id){
    global $dbc;
    //check if user exist
    $query_check = "SELECT * FROM `states` WHERE `state_id` = $state_id ";

    $res_check = mysqli_query($dbc,$query_check);
    $num = mysqli_num_rows($res_check);

    if($num==0){
        return false;
    }else{
        //retreive data to be used for Session data
        $cities = mysqli_fetch_all($res_check,MYSQLI_ASSOC);
        //redirect user to referer url or dashboard
        return $cities;
    }
}
include 'middleware/ensureLoggedIn.php';

if(isset($_POST['add_staff'])){
    //    exit(var_dump($_POST));
    if(validate_field($_POST['firstname']) && validate_field($_POST['lastname']) && validate_field($_POST['email']) && validate_field($_POST['phone']) && validate_field($_POST['movable']) && validate_field($_POST['dob']) && validate_field($_POST['qualification']) && validate_field($_POST['level']) && validate_field($_POST['gender'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $transfer_date = $_POST['last_transfer_date'];
        $level = @$_POST['level'];
        $dob = $_POST['dob'];
        $movable = $_POST['movable'];
        $qualification = $_POST['qualification'];
        $gender = $_POST['gender'];
        $location = $_POST['location'];
        $position = @$_POST['position'];
        $response = $admin->add_new_staff($firstname,$lastname,$email,$phone,$dob,$qualification,$transfer_date,$movable,$gender,$level,$location,$position);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_POST['add_faculty'])){
    if(validate_field($_POST['name'])){
        $name = $_POST['name'];
        $level = $_POST['level'];
        $response = $admin->add_faculty($name,$level);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_POST['add_location'])){
    // exit(var_dump($_POST));
    if(validate_field($_POST['name']) && validate_field($_POST['faculty_id'])){
        $name = $_POST['name'];
        $faculty_id = $_POST['faculty_id'];
        $positions = $_POST['positions'];
        $level = $_POST['level'];
        $response = $admin->add_location($name,$faculty_id,$positions, $level);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_POST['add_supervisor'])){
    // exit(var_dump($_POST));
    if(validate_field($_POST['name']) && validate_field($_POST['email']) || validate_field($_POST['faculty']) || validate_field($_POST['location'])){
        $name = $_POST['name'];
        $faculty_id = $_POST['faculty_id'];
        $positions = $_POST['positions'];
        $level = $_POST['level'];
        $response = $admin->add_location($name,$faculty_id,$positions, $level);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_GET['get_fac_locs'])){
    $faculty_id = @$_GET['fac_id'];
    $locations = $admin->get_faculty_locations($faculty_id);
//    exit(var_dump($locations));
    exit(json_encode($locations));
}

if(isset($_GET['get_loc_pos'])){
    $location_id = @$_GET['loc_id'];
    $positions = $admin->get_location_positions($location_id);
    exit(json_encode($positions));
}

if(isset($_POST['new_pos'])){
    if(validate_field($_POST['name'])){
        $name = @$_POST['name'];
        $response = $admin->add_new_position($name);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_POST['new_level'])){
    if(validate_field($_POST['name'])){
        $name = @$_POST['name'];
        $response = $admin->add_level($name);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_GET['transfer_all'])){
    // get all staff due for transfer
    $staff = $admin->get_staff_to_be_transfererd();
    if(!empty($staff)){
        foreach ($staff as $st){
            $staff_id = $st['staff_id'];
            $admin->set_staff_new_location($staff_id);
        }
        $response = json_encode(array("status"=>1,"message"=>"Transfer Completed Successfully"));
    }else{
        $response = json_encode(array("status"=>0,"message"=>"No staff to be Transferred at the moment!"));
    }
    exit($response);
}

if(isset($_POST['update_settings'])){
    $interval = @$_POST['interval'];
    if($interval){
        $response = $admin->update_settings($interval);
    }else{
        $response = json_encode(["status"=>0,"messages"=>"Sorry, Transfer Interval Field is required"]);
    }
    exit($response);
}

if(isset($_POST['update_password'])){
    $old_password = @$_POST['old_password'];
    $new_password = @$_POST['new_password'];
    $confirm_new_password = @$_POST['confirm_new_password'];
    $admin_id = @$_POST['admin_id'];
    // validate input
    if(validate_field($old_password) && validate_field($new_password) && validate_field($confirm_new_password) &&
        $admin_id){
        if($new_password === $confirm_new_password){
            $response = $admin->change_password($admin_id,$old_password,$new_password);
        }else{
            $response = json_encode(["status"=>0,"messages"=>"Please Confirm your new password"]);
        }
    }else{
        $response = json_encode(["status"=>0,"messages"=>"Please Fill All Required Fields"]);
    }
    exit($response);
}


