<?php
include('../config.php');

$status = false;
$message = '';

if(isset($_REQUEST['lng']) && isset($_REQUEST['lat'])) {
    $sql = '';
} else {
    $message = 'Missing arguments lng and lat';
    $data = array(
        'status'    => $status,
        'message'   => $message
    );
}

echo json_encode($data);

?>