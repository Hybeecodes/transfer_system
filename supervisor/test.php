<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 3/20/2019
 * Time: 12:55 PM
 */

include "../app/init.php";
$supervisor = new Supervisor($db_conn);
exit($supervisor->get_name('superv5c922a988a31a'));