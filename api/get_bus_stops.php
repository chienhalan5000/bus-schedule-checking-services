<?php
include('../config.php');

$status = false;
$message = '';
$data = array();

if(isset($_REQUEST['Route'])) {
    $status = true;
    $route = $_REQUEST['Route'];
    $arrBusStops = array();

    $sql = "SELECT * FROM bus_stops WHERE find_in_set('$route',Routes) ";
    $query = mysqli_query($CONNECT_SQL, $sql);

    while ($result = mysqli_fetch_assoc($query)) {
        array_push($arrBusStops, $result);
    }

    $data = array(
        'status'    => $status,
        'data'      => $arrBusStops
    );
} else {
    $message = 'Missing argument Route';

    $data = array(
        'status'    => $status,
        'message'   => $message
    );
}

echo json_encode($data);
?>