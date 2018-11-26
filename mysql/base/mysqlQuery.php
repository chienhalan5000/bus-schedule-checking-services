<?php
function sqlConnect($dbhost, $dbname, $dbpass, $dbuser){
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    mysqli_set_charset($conn, "utf8"); 
    if(!$conn){
        echo mysqli_connect_error($conn);
        exit;
    }
    return $conn;
}

?>