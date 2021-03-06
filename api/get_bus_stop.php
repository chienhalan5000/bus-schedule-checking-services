<?php
/**
 * API get bus top information by stop id 
 * Method: GET
 * Argument: StopId id of bus stop want to get
 */
include('../config.php');

$status = false;
$message = '';
$data = array();

if(isset($_REQUEST['StopId'])) {
    $id = $_REQUEST['StopId'];
    $status = true;

    $sql = "SELECT * FROM bus_stops WHERE StopId = $id";
    $query = mysqli_query($CONNECT_SQL, $sql);
    $result = mysqli_fetch_assoc($query);

    $data = array(
        'status'    => $status,
        'data'      => $result
    );
    
} else {
    $message = 'Missing argument StopId';

    $data = array(
        'status'    => $status,
        'message'   => $message
    );
}

echo json_encode($data);
?>