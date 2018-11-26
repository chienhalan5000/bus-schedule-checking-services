<?php
include('mysql/base/mysqlQuery.php');

unset($CONNECT_SQL);

global $CONNECT_SQL;

$dbhost = 'localhost';
$dbname = 'bus_stops';
$dbuser = 'root';
$dbpass = 'mysql';

$CONNECT_SQL = sqlConnect($dbhost, $dbname, $dbpass, $dbuser);

?>