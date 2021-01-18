<?php

class Harviacode
{

    private $host;
    private $user;
    private $password;
    private $database;
    private $sql;

    function __construct()
    {
        $this->connection();
    }

    function connection()
    {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->database = 'iklanbaris';

        $this->sql = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->sql->connect_error)
        {
            echo $this->sql->connect_error . ", please check 'application/config/database.php'.";
            die();
        }
    }

    function table_list()
    {
        $query = "SELECT table_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$this->database' GROUP BY table_name";
        $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $stmt->bind_param('s', $this->database);
        $stmt->bind_result($table_name);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('table_name' => $table_name);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }
    
function kolom($table)
    {
 $query = "SELECT column_name, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE `TABLE_SCHEMA` = '$this->database' AND TABLE_NAME='$table'";

        $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (bukan kolom)");

        $stmt->bind_param('s', $this->database);
        $stmt->bind_result($nama_kolom, $column_comment);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('nama_kolom' => $nama_kolom, 'COLUMN_COMMENT' =>  $column_comment);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }

function primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$this->database' AND TABLE_NAME='$table' AND COLUMN_KEY='PRI'";
        $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (primary_field)");
        $stmt->bind_param('ss', $this->database, $table);
        $stmt->bind_result($column_name, $column_key, $column_comment);
        $stmt->execute();
        $stmt->fetch();
        return $column_name;
        $stmt->close();
        $this->sql->close();
    }

    function not_primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$this->database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'";
        $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $stmt->bind_param('ss', $this->database, $table);
        $stmt->bind_result($column_name, $column_key, $data_type, $column_comment);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type, 'COLUMN_COMMENT' =>  $column_comment);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }

    function all_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$this->database' AND TABLE_NAME='$table'";
        $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $stmt->bind_param('ss', $this->database, $table);
        $stmt->bind_result($column_name, $column_key, $data_type, $column_comment);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type, 'COLUMN_COMMENT' =>  $column_comment);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }

}

$hc = new Harviacode();
?>