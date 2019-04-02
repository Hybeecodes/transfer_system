<?php 
include '../app/init.php';
$admin = new Admin($db_conn);
// add new staff record
// what information do we need
// firstname, lastname, email, phone, location,dob, last transfer date,movable,
//gender,level, faculty, location, position
$firstnames = [ "Rachel","Edwards",
"Christopher","Perez",
"Thomas","Baker",
"Sara","Moore",
"Chris","Bailey"];
$lastnames = ["Roger","Johnson",
"Marilyn","Thompson",
"Anthony","Evans",
"Julie","Hall",
"Paula","Phillips"];
$genders = ['male','female'];
$faculties = [''];

for($i = 0; $i < 10; $i++){
    $firstname = $firstnames[$i];
    $lastname = $lastnames[$i];
    $gender = $genders[rand(0,1)];
    $email = "$firstname$lastname@gmail.com";
    $phone = "08077473536";
    $dob = date('1960-02-05');
    $qualification = "BSc";
    $transfer_date = date('2014-02-05');
    $movable = 1;
    $level = "level5c8e198124d11";
    $faculty = "faculty_id5c8e1f0c7bcfa";
    $locations = $admin->get_faculty_locations($faculty);
    $location = $locations[rand(0,count($locations)-1)]['location_id'];
    $positions = $admin->get_location_positions($location);
    $position = $positions[rand(0,count($positions)-1)]['position_id'];
    $response = $admin->add_new_staff($firstname,$lastname,$email,$phone,$dob,$qualification,$transfer_date,$movable,$gender,$level,$location,$position);
}


?>