<?php
    include('./config.php');

    $url ="http://api.openfpt.vn/fbusinfo/businfo/getstopsinbounds/106/10/107/11";
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

    foreach($obj as $key => $value) {
        $sql = "INSERT INTO bus_stops (StopId, Code, Name, StopType,Zone , Ward, AddressNo,Street ,SupportDisability ,Status ,Lng ,Lat, Search, Routes)
        VALUES (".$value['StopId'].",'".$value['Code']."','".$value['Name']."','".$value['StopType']."','".$value['Zone']."','".$value['Ward']."','
        ".$value['AddressNo']."','".$value['Street']."','".$value['SupportDisability']."','".$value['Status']."',".$value['Lng'].",
        ".$value['Lat'].",'".$value['Search']."','".$value['Routes']."')";

        mysqli_query($CONNECT_SQL, $sql);
    }

    var_dump($obj);
?>