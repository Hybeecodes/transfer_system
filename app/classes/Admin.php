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

    public function add_new_staff($firstname,$lastname,$email,$phone,$year_of_employment,$dob,$qualification,$year_of_retirement,$gender,$location_id){
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
            "location_id" => $location_id,
            "date_of_birth"=>$dob,
            "qualification"=>$qualification,
            "year_of_retirement"=>$year_of_retirement,
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
        $data = "*";
        $table = "staff_current_posting";
        $where =  "WHERE staff_id = '$staff_id'";
        $posting_location = $this->getData($data,$table,$where);
        $posting = empty($posting_location) ?  [] :  $posting_location;
        return $posting;
    }

    public function generate_staff_new_transfer_location($staff_id){
        // get staff details
        $staff_details = $this->get_staff_details($staff_id);
        // get all locations
        $locations = $this->get_all_location_names();
        // filter available locations based on the staff transfer history and availability of location

        // randomly select a location

        // set the location as staff transfer location
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

    /**
     * @param $staff_id
     * @return mixed
     */
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
        $where = "WHERE transfer_date <= CURDATE()";
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

    public function add_location($location_name,$faculty_id){
        $data = array(
            "location_id"=> $this->generate_id("location"),
            "faculty_id"=>$faculty_id,
            "name"=> $location_name
        );
        $table = "locations";
        $res = $this->insertData($data,$table);
        $response = $res ? ["status" => 1, "message" => "New Location is Created Successfully!"] : ["status" => 0, "message" => "Sorry, Unable to Add Location Staff"];
        return json_encode($response);
    }

    public function get_faculties(){
        $data ="*";
        $table = "faculties";
        $res = $this->getAllData($data,$table);
        $faculties = !empty($res) ? $res : [];
        return $faculties;
    }

    public function get_all_locations(){
        $data = "*";
        $table = "locations";
        $res = $this->getAllData($data,$table);
        $locations = !empty($res) ? $res : [];
        return $locations;
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
        $data = ['name'];
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
}