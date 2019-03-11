<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 11/4/18
 * Time: 8:23 PM
 */

class Admin extends Master
{

    public function __construct($db_conn){
        Master:: __construct($db_conn);
    }

    public function admin_login($email,$password){
        $password = md5($password);
        $data = "*";
        $table = "admin";
        $where = "WHERE email = '$email' AND password = '$password'";
        $admin = $this->getData($data,$table,$where);
        if(empty($admin)){
            $response = array("status"=>0,"message"=>"Sorry, Invalid Email or Password ");
        }else{
            $_SESSION['admin_session'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['firstname']." ".$admin['lastname'];
        //            $_SESSION['role'] = $admin['role'];
            $response = array("status"=>1,"message"=>"Admin Login Successful!");
        }
        return json_encode($response);
    }

    public function change_password($admin_id,$old_password,$new_password)
    {
        $password = md5($new_password);
        $old_password = md5($old_password);
        $data = [
            "password"=> $password
        ];
        $table = "admin";
        $where = "WHERE password = '$old_password' AND admin_id = '$admin_id'";
        $res = $this->updateData($data,$table,$where);
        $response =  ($res)? ["status"=>1, "message"=> "Password Updated Successfully"] : ["status"=> 0, "message"=> "Sorry, Unable to update password"];
        return json_encode($response);
    }

    public function current()
    {
        return isset($_SESSION['admin_session'])? $_SESSION['admin_session'] : false;
    }

    public function get_admin_details($admin_id){
        $data = "*";
        $table = "admin";
        $where = "WHere admin = '$admin_id'";
        $admin = $this->getData($data,$table,$where);
        if(empty($admin)){
            return array();
        }else{
            return $admin;
        }
    }

    public function create_admin_user($email,$password,$name,$role){
        $password =  md5($password);
        $data = array(
            "admin_id"=>$this->generate_id("admin"),
            "email"=>$email,
            "password"=>$password,
            "name"=>$name,
            "role"=>$role
        );
        $table = "admin";
        $res = $this->insertData($data,$table);
        if($res){
            $response = array("status"=>1,"message"=>"Admin User Created Successfully");
        }else{
            $response = array("status"=>0,"message"=>"Sorry, Unable to Create Admin User");
        }
        return json_encode($response);
    }

    public function add_new_staff($firstname,$lastname,$email,$phone,$year_of_employment,$dob,$qualification,$transfer_date,$gender,$faculty_id,$location_id,$position_id){
        $d = new DateTime($dob);
        $now = new DateTime();
        $age = $now->diff($d)->y;
        $staff_id = $this->generate_id("staff");
        $data = array(
            "staff_id"=>$staff_id,
            "firstname"=>$firstname,
            "lastname"=>$lastname,
            "email"=>$email,
            "phone"=>$phone,
            "year_of_employment"=>$year_of_employment,
            "last_transfer_date"=> $transfer_date,
            "faculty_id"=>$faculty_id,
            "location_id" => $location_id,
            "position_id" => $position_id,
            "date_of_birth"=>$dob,
            "qualification"=>$qualification,
            "age"=>$age,
            "gender"=>$gender
        );
        $this->set_staff_transfer_interval($staff_id);
        $table= "staff";
        $res = $this->insertData($data,$table);
        if (!empty($res)) {
            $response = $res ? array("status" => 1, "message" => "New Staff is Created Successfully!") : array("status" => 0, "message" => "Sorry, Unable to Add New Staff");
        }
        return json_encode($response);
    }

    public function search_staff($query)
    {
        $data = "*";
        $table = "staff";
        $where = "WHERE name %LIKE% $query";
        $res = $this->getAllData($data,$table,$where);
        return empty($res)? []: $res;
    }

    public function update_settings($interval)
    {
        $data = [
            "transfer_interval"=> $interval
        ];
        $table = "settings";
        $res = $this->updateData($data,$table);
        $response =  ($res)? ["status"=>1,"message"=>"System Settings Updated Successfully"]: ["status"=>0,
            "message"=>"Sorry, Unable to Update settings"];
        return json_encode($response);
    }

    public function get_settings(){
        $data = "*";
        $table = "settings";
        $res = $this->getData($data,$table);
        return empty($res)? [] : $res;
    }
    
    public function add_staff_posting_history($staff_id,$location_id){
        $data = array("staff_id"=>$staff_id,"location_id"=>$location_id);
        $table = "posting_history";
        $res = $this->insertData($data,$table);
        return $res;
    }

    /**
     * @param $staff_id
     * @return array
     */
    public function get_staff_posting_history($staff_id)
    {
        $data = "*";
        $table = "posting_history";
        $where = "WHERE staff_id = '$staff_id'";
        $posting_history = $this->getAllData($data,$table,$where);
        if(empty($posting_history)) return [];
        else return $posting_history;
    }

    public function add_staff_posting($staff_id,$location_id)
    {
        $data = array(
            "staff_id"=>$staff_id,
            "location_id"=> $location_id
        );
        $table = "staff_current_posting";
        $res = $this->insertData($data,$table);
        if (!empty($res)) {
            $response = $res ? array("status" => 1, "message" => "Staff Posting Successfully!") : array("status" => 0, "message" => "Sorry, Unable to Post Staff");
        }
        return json_encode($response);
    }

    public function update_staff_posting($staff_id,$location_id)
    {
        $data = array(
            "location_id" => $location_id,
            "updated_at" => date('Y-m-d')
        );
        $table = "staff_current_posting";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->updateData($data,$table,$where);
        $response = !empty($res) ? ($res ? ["status" => 1, "message" => "Staff Posting Successfully Updated"] : ["status" => 0, "message" => "Sorry, Unable to Update Staff Posting"]) : NULL;
        return json_encode($response);
    }

    public function get_staff_posting_location($staff_id)
    {
        $data = ["location_id"];
        $table = "staff";
        $where =  "WHERE staff_id = '$staff_id'";
        $posting_location = $this->getData($data,$table,$where);
        $posting = empty($posting_location) ?  "" :  $posting_location['location_id'];
        return $posting;
    }

    public function get_staff_posting_faculty($staff_id)
    {
        $data = ["faculty_id"];
        $table = "staff";
        $where =  "WHERE staff_id = '$staff_id'";
        $posting_faculty = $this->getData($data,$table,$where);
        $posting = empty($posting_faculty) ?  "" :  $posting_faculty['faculty_id'];
        return $posting;
    }

    public function check_if_location_available($location_id)
    {
        $data = "*";
        $table = "staff";
        $where = "WHERE location_id = '$location_id'";
        $staff = $this->getData($data,$table,$where);
        $res = !empty($staff) ? false : true;
        return $res;
    }

    public function set_staff_transfer_interval($staff_id)
    {
        // retirement age = 70
        // get staff age
        $retirement_date = $this->get_staff_details($staff_id)['year_of_retirement'];
        $d = new DateTime($retirement_date);
        $now = new DateTime();
        $years_before_retirement = $now->diff($d)->y;
        $transfer_interval = $years_before_retirement / 10;
        $data = array("transfer_interval"=>$transfer_interval);
        $table= "staff";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->updateData($data,$table,$where);
        return $res;
    }

    public function get_staff_to_be_transfererd()
    {
        $data = "*";
        $table = "staff";
        $t_i = $this->get_settings()['transfer_interval'];
        $where = "WHERE DATE_ADD(last_transfer_date, INTERVAL $t_i YEAR)  <= CURDATE()";
        $res = $this->getAllData($data,$table,$where);
        $faculties = !empty($res) ? $res : [];
        return $faculties;
    }

    public function is_staff_transferrable($staff_id)
    {
        $data = "*";
        $table = "staff";
        $where = "WHERE staff_id = '$staff_id' AND transfer_date <= CURDATE()";
        $staff = $this->getData($data,$table,$where);
        $res = !empty($staff) ? true : false;
        return $res;
    }

    public function get_faculties(){
        $data ="*";
        $table = "faculties";
        $res = $this->getAllData($data,$table);
        $faculties = !empty($res) ? $res : [];
        return $faculties;
    }

    public function add_faculty($faculty_name){
        $data = array(
            "faculty_id"=>$this->generate_id('faculty_id'),
            "name"=> $faculty_name
        );
        $table = "faculties";
        $res = $this->insertData($data,$table);
        $response = $res ? ["status" => 1, "message" => "New Faculty is Created Successfully!"] : ["status" => 0, "message" => "Sorry, Unable to Add Faculty Staff"];
        return json_encode($response);
    }

    public function get_faculty_name($faculty_id){
        $data = array("name");
        $table = "faculties";
        $where = "WHERE faculty_id = '$faculty_id'";
        $res = $this->getData($data,$table,$where);
        $name = !empty($res)? $res['name'] : "";
        return $name;
    }

    public function add_location($location_name,$faculty_id,$positions){
        $location_id = $this->generate_id("location");
        $data = array(
            "location_id"=> $location_id,
            "faculty_id"=>$faculty_id,
            "name"=> $location_name
        );
        $table = "locations";
        $res = $this->insertData($data,$table);
        if($res){
            foreach ($positions as $position_id){
                $this->set_location_position($location_id,$position_id);
            }
        }
        $response = $res ? ["status" => 1, "message" => "New Location is Created Successfully!"] : ["status" => 0, "message" => "Sorry, Unable to Add Location Staff"];
        return json_encode($response);
    }

    public function get_recent_transfers(){

    }

    
    

    public function set_location_position($location_id,$position_id)
    {
        $data = [
          "location_id"=>$location_id,
          "position_id"=>$position_id
        ];
        $table = "location_positions";
        $res = $this->insertData($data,$table);
        return $res;
    }

    public function get_all_locations(){
        $data = "*";
        $table = "locations";
        $res = $this->getAllData($data,$table);
        $locations = !empty($res) ? $res : [];
        return $locations;
    }

    public function get_location_name($location_id)
    {
        $data = ['name'];
        $table = "locations";
        $where = "WHERE location_id = '$location_id'";
        $location = $this->getData($data,$table,$where);
        return !empty($location)? $location['name']: "";
    }

    public function get_all_location_names(){
        $data = "*";
        $table = "locations";
        $res = $this->getAllData($data,$table);
        $locations = !empty($res) ? $res : [];
        $location_names = [];
        if(!empty($locations)){
            foreach ($locations as $location){
                array_push($location_names,$location['name']);
            }
        }
        return $location_names;
    }

    public function get_faculty_locations($faculty_id){
        $data = "*";
        $table = "locations";
        $where = "WHERE faculty_id = '$faculty_id'";
        $res = $this->getAllData($data,$table,$where);
        $locations = !empty($res) ? $res : [];
        return $locations;
    }

    public function get_all_staff()
    {
        $data = "*";
        $table = "staff";
        $staff = $this->getAllData($data,$table);
        if(empty($staff)){
            return array();
        }else{
            return $staff;
        }
    }

    public function get_staff_details($staff_id)
    {
        $data = "*";
        $table = "staff";
        $where = "WHERE staff_id = '$staff_id'";
        $staff = $this->getData($data,$table,$where);
        if(empty($staff)){
            return array();
        }else{
            return $staff;
        }
    }

    public function get_location_positions($location_id){
        $sql = "SELECT p.* FROM location_positions as l, positions as p WHERE l.position_id = p.position_id AND l.location_id = '$location_id'";
        $positions = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return empty($positions)? [] : $positions;
    }

    public function is_location_postion_available($location_id,$position_id)
    {
        $data = "*";
        $table = "staff";
        $where = "WHERE location_id = '$location_id' AND position_id = '$position_id'";
        $res = $this->getData($data,$table,$where);
        return (empty($res)) ? true: false;
    }

    public function get_all_positions()
    {
        $data = "*";
        $table= "positions";
        $res = $this->getAllData($data,$table);
        if(empty($res)){
            return [];
        }else{
            return $res;
        }
    }

    public function add_new_position($name)
    {
        $data = [
            "name"=>$name,
            "position_id"=>$this->generate_id('pos')
        ];
        $table = "positions";
        $res = $this->insertData($data,$table);
        $response = $res ? ["status" => 1, "message" => "New Position is Created Successfully!"] : ["status" => 0, "message" => "Sorry, Unable to Create Position"];
        return json_encode($response);
    }

    public function get_next_staff_location($staff_id){
        // get positing history
        $position_history = $this->get_staff_posting_history($staff_id);
        $current_location = $this->get_staff_posting_location($staff_id);
        $current_faculty =  $this->get_staff_posting_faculty($staff_id);
        // get locations
        $locations = $this->get_all_locations();
        $loc_len = count($locations);
        // randomize all locations
        $rand_location = $locations[rand(0,$loc_len-1)];
        // repeat rand until all conditions are met
        while(in_array($rand_location,$position_history) || $rand_location['location_id'] == $current_location){
            $rand_location = $locations[rand(0,$loc_len)];
        }
        // return rand value
        return $rand_location['location_id'];
    }

    public function update_last_transfer_date($staff_id)
    {
        $data = [
            "last_transfer_date" => date('Y-m-d')
        ];
        $table = "staff";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->updateData($data,$table,$where);
        return ($res)? true: false;
    }

    public function set_staff_new_location($staff_id)
    {
        // get staff next location
        $next_location = $this->get_next_staff_location($staff_id);
        $current_location = $this->get_staff_posting_location($staff_id);
        $current_faculty =  $this->get_staff_posting_faculty($staff_id);
        $data = ["location_id"=>$next_location];
        $table = "staff";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->updateData($data,$table,$where);
        if($res){
            $data = [
                "staff_id"=> $staff_id,
                "faculty_id"=>$current_faculty,
                "location_id"=> $current_location
            ];
            $table = "staff_transfer_history";
            $insert = $this->insertData($data,$table);
            $this->update_last_transfer_date($staff_id);
            return ($insert) ? true : false;
        }
        return false;
    }

    public function get_staff_transfer_history($staff_id)
    {
        $data = "*";
        $table = "staff_transfer_history";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->getAllData($data,$table,$where);
        return empty($res)? []: $res;
    }

    public function update_staff_details($staff_id){

    }

}
