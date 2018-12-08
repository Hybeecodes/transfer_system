<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 11/4/18
 * Time: 8:17 PM
 */

$dsn = 'mysql:dbname='.$config['DB_NAME'].';host='.$config['DB_HOST'];
$user = $config['DB_USER'];
$password = $config['DB_PASS'];

try {
    $db_conn = new PDO($dsn, $user, $password, array(
        PDO::ATTR_EMULATE_PREPARES=>false,
        PDO::MYSQL_ATTR_DIRECT_QUERY=>false,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    ));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage(); //You could have caught the error here.
}
