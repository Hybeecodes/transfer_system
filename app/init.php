<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 11/4/18
 * Time: 8:17 PM
 */
ob_start();
session_start();

include ('conn.php');
include ('db_conn.php');

global $db_conn;

include "classes/Master.php";
include "classes/Admin.php";
include "classes/Supervisor.php";


$master = new Master($db_conn);