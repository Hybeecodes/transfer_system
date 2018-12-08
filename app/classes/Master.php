<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 11/4/18
 * Time: 8:23 PM
 */

class Master
{
    protected $db;

    function __construct($db_conn){
        $this->db = $db_conn;
    }

    public function getData($data, $table, $where = '')
    {
        try {
            if ($data != '*') {
                $selections = implode(', ', $data);
            } else {
                $selections = '*';
            }

            $stmt = $this->db->prepare("SELECT {$selections} FROM `$table` " . $where . " LIMIT 1");
            // echo "SELECT {$selections} FROM `$table` " . $where . " LIMIT 1";
            $stmt->execute();
            $settings_data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return $settings_data;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function updateData($array, $table, $where = '')
    {

        try {

            $fields = array_keys($array);
            $values = array_values($array);
            $fieldlist = implode(',', $fields);
            $qs = str_repeat("?, ", count($fields) - 1);
            $firstfield = true;

            $sql = "UPDATE `$table` SET";

            for ($i = 0; $i < count($fields); $i++) {
                if (!$firstfield) {
                    $sql .= ", ";
                }
                $sql .= " " . $fields[$i] . "= ? ";
                $firstfield = false;
            }
            if (!empty($where)) {
                $sql .= $where;
            }
            $sth = $this->db->prepare($sql);
            return $sth->execute($values);

            return $sth;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function send_mail($to,$subject,$content){

        $body = '<p>
                    Hi,
                    <br>'.$content.'
                    <br>
                    Thanks
                    
                    </p>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .='From:<noreply@mediapay.com.ng>' . "\r\n";

        $res = mail($to,$subject,$body,$headers);
        return $res;
    }
    public function generate_id($prefix){
        $id = uniqid($prefix);
        return $id;
    }

    public function insertData($array, $table)
    {

        try {

            $fields = array_keys($array);
            $values = array_values($array);
            $fieldlist = implode(',', $fields);
            $qs = str_repeat("?,", count($fields) - 1);
            $firstfield = true;

            $sql = "INSERT INTO `$table` SET";

            for ($i = 0; $i < count($fields); $i++) {
                if (!$firstfield) {
                    $sql .= ", ";
                }
                $sql .= " " . $fields[$i] . "=?";
                $firstfield = false;
            }

            $sth = $this->db->prepare($sql);
            return $sth->execute($values);

            return $sth;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllData($data, $table, $where = '')
    {
        $settings_data=array();
        try {
            if ($data != '*') {
                $selections = implode(', ', $data);
            } else {
                $selections = '*';
            }

            $stmt = $this->db->prepare("SELECT {$selections} FROM `$table` " . $where . "");
            $stmt->execute();
            $settings_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return $settings_data;
            }
        } catch (PDOException $e) {
            return $settings_data;
        }
    }
}