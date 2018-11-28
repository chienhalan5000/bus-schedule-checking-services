<?php
$status = false;
$message = '';

if(isset($_REQUEST['lng1']) && isset($_REQUEST['lat1']) && isset($_REQUEST['lng2']) && isset($_REQUEST['lat2'])) {

} else {
    $message = 'Missing argument';

    $data = array(
        'status'    => $status,
        'message'   => $message
    );
}

echo json_encode($data);
?>