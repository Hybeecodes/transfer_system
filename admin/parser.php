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
        $transfer_date = $_POST['transfer_date'];
        $dob = $_POST['dob'];
        $qualification = $_POST['qualification'];
        $gender = $_POST['gender'];
        $faculty = @$_POST['faculty'];
        $location = $_POST['location'];
        $position = @$_POST['position'];
        $response = $admin->add_new_staff($firstname,$lastname,$email,$phone,$employment_year,$dob,$qualification,$transfer_date,$gender,$faculty,$location,$position);
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
        $positions = $_POST['positions'];
        $response = $admin->add_location($name,$faculty_id,$positions);
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


