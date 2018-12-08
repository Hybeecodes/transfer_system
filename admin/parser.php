<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/18/2018
 * Time: 10:38 AM
 */

include '../app/init.php';
include '../middleware/ensureLoggedIn.php';

//
$admin = new Admin($db_conn);

function validate_field($field){
    return isset($field) && $field != '';
}

if(isset($_POST['add_staff'])){
//    exit(var_dump($_POST));
    if(validate_field($_POST['firstname']) && validate_field($_POST['lastname']) && validate_field($_POST['email']) && validate_field($_POST['phone']) && validate_field($_POST['employment_year']) && validate_field($_POST['dob']) && validate_field($_POST['qualification']) && validate_field($_POST['retirement_year']) && validate_field($_POST['gender'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $employment_year = $_POST['employment_year'];
        $dob = $_POST['dob'];
        $qualification = $_POST['qualification'];
        $retirement_year = $_POST['retirement_year'];
        $gender = $_POST['gender'];
        $location_id = $_POST['location_id'];
        $response = $admin->add_new_staff($firstname,$lastname,$email,$phone,$employment_year,$dob,$qualification,$retirement_year,$gender,$location_id);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}

if(isset($_POST['add_faculty'])){
    if(validate_field($_POST['name'])){
        $name = $_POST['name'];
        $response = $admin->add_faculty($name);
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
        $response = $admin->add_location($name,$faculty_id);
    }else{
        $response = json_encode(array("status"=>0,"message"=>"Sorry, Please fill all fields !"));
    }
    exit($response);
}


