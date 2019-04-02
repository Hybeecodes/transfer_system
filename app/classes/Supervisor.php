<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 3/14/19
 * Time: 6:10 AM
 */

class Supervisor extends Master
{
    public function login($email, $password)
    {
        $password = md5($password);
        $data = "*";
        $table = "supervisors";
        $where = "WHERE email = '$email' AND password = '$password'";
        $supervisor = $this->getData($data, $table, $where);
        if(empty($supervisor)){
            return json_encode(["status"=>0, "message" => "Invalid Login Details"]);
        }else{
            $_SESSION['supervisor_id'] = $supervisor['supervisor_id'];
            $_SESSION['supervisor_email'] = $supervisor['email'];
            $_SESSION['supervisor_location'] = $supervisor['location_id'];
            return json_encode(["status"=>1, "message" => "Login Successful"]);
        }
    }

    
    public function get_location_name($location_id)
    {
        $data = ['name'];
        $table = "locations";
        $where = "WHERE location_id = '$location_id'";
        $location = $this->getData($data,$table,$where);
        return !empty($location)? $location['name']: "";
    }

    public function get_my_staff($location)
    {
        $data =  "*";
        $table = "staffs";
        $where = "WHERE location_id = '$location'";
        $staff = $this->getAllData($data, $table, $where);
        return empty($staff)? []: $staff;
    }

    public function request_new_staff($supervisor_id, $location_id, $details)
    {
        $data = [
            "supervisor_id" => $supervisor_id,
            "location_id" => $location_id,
            "details" => $details
        ];
        $table = "requests";
        $new_request  = $this->insertData($data, $table);
        if($new_request){
            return json_encode(["status" => 1, "message" => "New Staff Request Succcessfully Sent"]);
        }else{
            return json_encode(["status" => 0, "message" => "Sorry, Unable to send new staff request"]);
        }
    }

    public function get_name($id){
        $data = ["name"];
        $table ="supervisors";
        $where = "WHERE supervisor_id = '$id'";
        $res = $this->getData($data,$table,$where);
        return $res['name'];
    }

    public function give_staff_feedback($supervisor_id,$location, $staff_id,$title,$details)
    {
        $data = [
            "feedback_id" => $this->generate_id("feedback"),
            "supervisor_id" => $supervisor_id,
            "staff_id" => $staff_id,
            "title" => $title,
            "location_id" => $location,
            "supervisor_name"=> $this->get_name($supervisor_id),
            "details" => $details
        ];
        $table = "feedbacks";
        $feedback = $this->insertData($data, $table);
        if($feedback){
            return json_encode(["status" => 1, "message" => "Feedback Succcessfully Sent"]);
        }else{
            return json_encode(["status" => 0, "message" => "Sorry, Unable to send Feedback"]);
        }
    }

}