<?php

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){  
    $url = "https://";   
}else{ 
    $url = "http://"; 
}  
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];
$LOCAL = strpos($url, 'localhost') ? 1 : 0;

define('ROOT_PATH', realpath(dirname(__FILE__)));
    define('HOST', 'localhost');
if($LOCAL){
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'payment');
}else{
    define('DB_USER', 'storelad_newshoura');
    define('DB_PASS', 'rEhtoM14m7y');
    define('DB_NAME', 'storelad_newshour');
}

$host = HOST;
$user = DB_USER;
$pass = DB_PASS;
$db_name = DB_NAME;

$conn = new mySQLi($host, $user, $pass, $db_name);

if($conn->connect_error){
    die('Database Connection Erorr: ' . $conn->connect_error );
}

function executeQurey($sql, $data) {
    global $conn;
    
        $stmt = $conn->prepare($sql);
        $value = array_values($data);
        $type = str_repeat('s', count($value));
        $stmt->bind_param($type, ...$value);
        $stmt->execute();
        return $stmt;
}

    function create($table, $data) {
        global $conn;
    
        $sql = "INSERT INTO $table SET ";
        $i = 0;
        foreach ($data as $key=>$value)
            {
            if ($i === 0) {
                $sql = $sql . "$key=?";
            } else {
                $sql = $sql . ", $key=?";
            }
            $i++;   
        }
        $stmt = executeQurey($sql, $data);
        $id = $stmt->insert_id;
        return $id;
    }
