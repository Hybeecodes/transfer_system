<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 4:16 PM
 */
include '../app/init.php';
session_destroy();
header('location: ../index.php');