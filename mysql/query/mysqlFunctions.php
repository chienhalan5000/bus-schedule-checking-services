<?php
include_once(__DIR__ . "/../../config.php");

function get_bus_stop_by_StopId($id) {
    GLOBAL $CONNECT_SQL;

    $sql = "SELECT * FROM bus_stops WHERE StopId = $id";
    $query = mysqli_query($CONNECT_SQL, $sql);
    $result = mysqli_fetch_assoc($query);

    return $result;
}

function get_bus_stops_by_Route($route) {
    GLOBAL $CONNECT_SQL;
    $arrBusStops = array();

    $sql = "SELECT * FROM bus_stops WHERE find_in_set('$route',Routes) ";
    $query = mysqli_query($CONNECT_SQL, $sql);

    while ($result = mysqli_fetch_assoc($query)) {
        array_push($arrBusStops, $result);
    }

    return $arrBusStops;
}

 function get_fpt_api($url) {
    $apiKey = '28ee4e2910b1472a94538e465070f3b3';
    $header = array(
        'api_key:' . $apiKey
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $result = curl_exec($ch);

    curl_close($ch);

    $obj = json_decode($result, TRUE);

    return $obj;
 }

?>