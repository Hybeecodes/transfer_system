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
