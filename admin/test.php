<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 12/28/18
 * Time: 7:24 AM
 */
include '../app/init.php';

$admin = new Admin($db_conn);

//$locs = $admin->get_faculty_locations('faculty_id5bfa97d25b16c');
$new_transfer = $admin->transfer_staff('staffs5ca2fb0975072');
//$check = $admin->check_location_has_position($location_id, $position_id);
var_dump($new_transfer);