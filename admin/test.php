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
$loc = $admin->get_next_staff_location('staff5bf3ffce2b05f');
var_dump($loc);