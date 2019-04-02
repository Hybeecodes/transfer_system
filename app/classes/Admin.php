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

    public function location_has_supervisor($location_id)
    {
        $data = "*";
        $table = "supervisors";
        $where = "WHERE location_id = '$location_id'";
        $res = $this->getData($data,$table,$where);
        return empty($res)? true : false;
    }

    public function add_supervisor($firstname,$lastname,$email,$password,$location)
    {
        $password = md5($password);
        if($this->location_has_supervisor($location)){
            $data  =[
                "firstname"=> $firstname,
                "lastname"=> $lastname,
                "email" => $email,
                "password" => $password,
                "location_id"=> $location
            ];
            $table = "supervisors";
            $new_supervisor = $this->insertData($data, $table);
            if($new_supervisor){
                $response = array("status"=>1,"message"=>"Supervisor Created Successfully");
            }else{
                $response = array("status"=>0,"message"=>"Sorry, Unable to Create Supervisor");
            }
        }else{
            $response = array("status"=>0,"message"=>"Sorry,This Location has a Supervisor Already");
        }

        return json_encode($response);
    }

    public function get_supervisor(){
        $data = "*";
        $table = "supervisors";
        $supervisors = $this->getAllData($data,$table);
        return empty($supervisors)? []: $supervisors;
    }

    public function get_feeedbacks()
    {
        $data = "*";
        $table = "feedbacks";
        $feedbacks = $this->getAllData($data, $table);
        return empty($feedbacks)? []: $feedbacks;
    }

    public function get_requests()
    {
        $data = "*";
        $table = "requests";
        $requests = $this->getAllData($data, $table);
        return empty($requests)? []: $requests;
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

    public function add_new_staff($firstname,$lastname,$email,$phone,$dob,$qualification,$transfer_date,$movable,$gender,$level,$location_id,$position_id){
        $d = new DateTime($dob);
        $now = new DateTime();
        $age = $now->diff($d)->y;
        $staff_id = $this->generate_id("staffs");
        $data = array(
            "staff_id"=>$staff_id,
            "firstname"=>$firstname,
            "lastname"=>$lastname,
            "email"=>$email,
            "phone"=>$phone,
            "last_transfer_date"=> $transfer_date,
            "location_id" => $location_id,
            "position_id" => $position_id,
            "dob"=>$dob,
            "is_movable" => $movable,
            "qualification"=>$qualification,
            "age"=>$age,
            "gender"=>$gender
        );
        // $this->set_staff_transfer_interval($staff_id);
        $table= "staffs";
        $res = $this->insertData($data,$table);
        if (!empty($res)) {
            $response = $res ? array("status" => 1, "message" => "New Staff is Created Successfully!") : array("status" => 0, "message" => "Sorry, Unable to Add New Staff");
        }
        return json_encode($response);
    }

    public function search_staff($query)
    {
        $data = "*";
        $table = "staffs";
        $where = "WHERE name %LIKE% $query";
        $res = $this->getAllData($data,$table,$where);
        return empty($res)? []: $res;
    }

    public function update_settings($interval)
    {
        $data = [
            "value"=> $interval
        ];
        $table = "settings";
        $where = "WHERE name = transfer_interval";
        $res = $this->updateData($data,$table);
        $response =  ($res)? ["status"=>1,"message"=>"System Settings Updated Successfully"]: ["status"=>0,
            "message"=>"Sorry, Unable to Update settings"];
        return json_encode($response);
    }

    public function get_settings($name){
        $data = "*";
        $table = "settings";
        $where = "WHERE name = '$name'";
        $res = $this->getData($data,$table);
        return empty($res)? [] : $res['value'];
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
        $table = "staffs";
        $where =  "WHERE staff_id = '$staff_id'";
        $posting_location = $this->getData($data,$table,$where);
        $posting = empty($posting_location) ?  "" :  $posting_location['location_id'];
        return $posting;
    }

    public function get_staff_posting_faculty($staff_id)
    {
        $data = ["faculty_id"];
        $table = "staffs";
        $where =  "WHERE staff_id = '$staff_id'";
        $posting_faculty = $this->getData($data,$table,$where);
        $posting = empty($posting_faculty) ?  "" :  $posting_faculty['faculty_id'];
        return $posting;
    }

    public function check_if_location_available($location_id)
    {
        $data = "*";
        $table = "staffs";
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
        $table= "staffs";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->updateData($data,$table,$where);
        return $res;
    }

    public function get_staff_to_be_transfererd()
    {
        $data = "*";
        $table = "staffs";
        $t_i = $this->get_settings('transfer_interval');
        $where = "WHERE DATE_ADD(last_transfer_date, INTERVAL $t_i YEAR)  <= CURDATE()";
        $res = $this->getAllData($data,$table,$where);
        $faculties = !empty($res) ? $res : [];
        return $faculties;
    }

    public function is_staff_transferrable($staff_id)
    {
        $data = "*";
        $table = "staffs";
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

    public function add_faculty($faculty_name, $level){
        $data = array(
            "faculty_id"=>$this->generate_id('faculty_id'),
            "name"=> $faculty_name,
            "level_id" => $level
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

    public function add_location($location_name,$faculty_id,$positions,$level){
        $location_id = $this->generate_id("location");
        $data = array(
            "location_id"=> $location_id,
            "faculty_id"=>$faculty_id,
            "name"=> $location_name,
            "level_id"=>$level
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
    public function get_staff_name($staff_id)
    {
        $data = ['firstname','lastname'];
        $table = "staffs";
        $where = "WHERE staff_id = '$staff_id'";
        $staff = $this->getData($data,$table,$where);
        $firstname = $staff['firstname'];
        $lastname = $staff['lastname'];
        return !empty($staff)? "$firstname $lastname": "";
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
        $sql = "SELECT * FROM locations WHERE faculty_id = '$faculty_id'";
        // $res = $this->db->query($sql)->fetchAll();
        // exir($sql);
        $locations = !empty($res) ? $res : [];
        return $locations;
    }

    public function get_all_staff()
    {
        $data = "*";
        $table = "staffs";
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
        $table = "staffs";
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
        $table = "staffs";
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
        // check if position exists before
        $data = '*';
        $table = "positions";
        $where = "WHERE name = '$name'";
        $position = $this->getData($data,$table,$where);
        if(!empty($position)){
            return json_encode(["status"=>0,"message"=>"Positon Exists Already"]);
        }else{
            $data = [
                "name"=>$name,
                "position_id"=>$this->generate_id('pos')
            ];
            $table = "positions";
            $res = $this->insertData($data,$table);
            $response = $res ? ["status" => 1, "message" => "New Position is Created Successfully!"] : ["status" => 0, "message" => "Sorry, Unable to Create Position"];
            return json_encode($response);
        }
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
        $table = "staffs";
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
        $table = "staffs";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->updateData($data,$table,$where);
        if($res){
            $data = [
                "staff_id"=> $staff_id,
                "faculty_id"=>$current_faculty,
                "location_id"=> $current_location
            ];
            $table = "transfer_history";
            $insert = $this->insertData($data,$table);
            $this->update_last_transfer_date($staff_id);
            return ($insert) ? true : false;
        }
        return false;
    }

    public function get_location_faculty($location_id){
        $data = ["faculty_id"];
        $table = "locations";
        $where = "WHERE location_id = '$location_id'";
        $res = $this->getData($data,$table,$where);
        return empty($res)? 0: $res['faculty_id'];
    }

    public function get_staff_transfer_history($staff_id)
    {
        $data = "*";
        $table = "transfer_history";
        $where = "WHERE staff_id = '$staff_id'";
        $res = $this->getAllData($data,$table,$where);
        return empty($res)? []: $res;
    }

    public function update_staff_details($staff_id){

    }

    public function add_level($name){
        $level_id = $this->generate_id('level');
        $data = ["level_id"=>$level_id,"name"=> $name];
        $table = "levels";
        $add_level = $this->insertData($data,$table);
        $response = $add_level ? ["status" => 1, "message" => "New Level is Created Successfully!"] : ["status" => 0, "message" => "Sorry, Unable to Create Level"];
        return json_encode($response);
    }

    public function get_levels(){
        $data = "*";
        $table = "levels";
        $levels = $this->getAllData($data,$table);
        return empty($levels)? [] : $levels;
    }

    public function check_location_has_position($location_id, $position_id){
        $data = "*";
        $table = "location_positions";
        $where = "WHERE location_id = '$location_id' AND position_id = '$position_id'";
        $res = $this->getData($data,$table, $where);
        return empty($res)? false: true;
    }

    public function get_level_faculty($level)
    {
        $data = "*";
        $table = "faculties";
        $where = "WHERE level_id = '$level'";
        $faculties = $this->getAllData($data,$table,$where);
        return empty($faculties)? []: $faculties;
    }

    public function get_level_faculty_locations($level,$faculty_id)
    {
        $data = "*";
        $table = "locations";
        $where = "WHERE level_id = '$level' AND faculty_id = '$faculty_id'";
        $faculties = $this->getAllData($data,$table,$where);
        return empty($faculties)? []: $faculties;
    }

    public function get_locations_that_match($position_id,$locations){
        $locs = [];
        // return $position_id;
        return $locations;
        if(!empty($locations)){
            foreach ($locations as $location) {
                // get all location positions
                $data = ["position_id"];
                $table = "location_positions";
                $location_id = $location['location_id'];
                $where = "WHERE location_id = '$location_id'";
                $pos = $this->getAllData($data,$table,$where);
                if(!empty($pos)){
                    if(in_array($position_id,$pos)){
                        array_push($locs,$location);
                    }
                }
            }
        }
        return $locs;
    }
    
    public function transfer_staff($staff_id)
    {
        $position_history = $this->get_staff_posting_history($staff_id);
        $staff = $this->get_staff_details($staff_id);
        $current_location = $staff['location_id'];
        $staff_level = $staff['level_id'];
        $staff_position = $staff['position_id'];
        $faculties = $this->get_level_faculty($staff_level);
        $current_faculty = $this->get_location_faculty($current_location);
//        exit(var_dump($faculties));
        // randomized faculty
        $fac_len = count($faculties);
        $rand_faculty = $faculties[rand(0,$fac_len-1)];
    //    exit($current_faculty);
        // repeat randomization if faculty is the same as the current faculty
        while($rand_faculty['faculty_id'] == $current_faculty
        || 
        empty($this->get_faculty_locations($rand_faculty['faculty_id']))
         #|| $rand_faculty['level_id'] != $staff_level
        ){
            $rand_faculty = $faculties[rand(0,$fac_len-1)];
        }
        // exit(var_dump($rand_faculty));
        // get rndomized locations also
        // first get all locations in the resulting faculty
        $fac_locations = $this->get_level_faculty_locations($staff_level,$rand_faculty['faculty_id']);
        $matched_locations = $this->get_locations_that_match($staff_position,$fac_locations);
        exit(var_dump($matched_locations));
        $loc_len = count($fac_locations);
        $rand_location = $fac_locations[rand(0,$loc_len-1)];
        // exit(var_dump($rand_location));
        while(in_array($rand_location,$position_history) ||
            !$this->check_location_has_position
            ($rand_location['location_id'], $staff_position)){
            $rand_location = $fac_locations[rand(0,$loc_len-1)];
        }
        // update new staff location 
        $data = [
            "location_id" => $rand_location['location_id'],
            "last_transfer_date" => date('Y-m-d')
        ];
        $table ="staffs";
        $where= "WHERE staff_id = '$staff_id'";
        $update_staff = $this->updateData($data,$table,$where);
        if($update_staff){
            // add to staff transfer history
            $data = [
                "staff_id" => $staff_id,
                "location_id" => $rand_location['location_id'],
                "position_id" => $staff_position
            ];
            $table= "transfer_history";
            $res = $this->insertData($data,$table);
        }
        return $update_staff? json_encode(["status"=>1,"message"=>"Staff Transfered Successfully"]): json_endocde(["status"=>0,"message"=>"Sorry, An Error Occured"]);
    }

    public function promote_staff($staff_id,$new_level){
        // get new location with new  level
    }

    public function get_list_of_free_positions_with_locations(){

    }

    

}
