<?php
include('../mysql/query/mysqlFunctions.php');

$status = false;
$message = '';

if(isset($_REQUEST['busStop']) && isset($_REQUEST['busRoutes'])) {
    $busRoutes_string = $_REQUEST['busRoutes'];
    $busStop = $_REQUEST['busStop'];
    $arr_useable_route = array();
    $url ="http://api.openfpt.vn/fbusinfo/prediction/predictbystopid/" . $busStop;

    $obj = get_fpt_api($url);
    
    foreach ($obj as $key => $value) {
        if(strpos($busRoutes_string, (string) $value['rNo']) !== false) {
            array_push($arr_useable_route, $value);
        }
    }



    ////////////////////////////////////////////////
        // $json = '[
        //     {
        //       "arrs": [
        //         {
        //           "d": 339.97608336271685,
        //           "dts": "2017-05-05T14:52:20+07:00",
        //           "s": 0,
        //           "sts": 0,
        //           "t": 90,
        //           "v": "53N3326"
        //         },
        //         {
        //           "d": 19106.985494202854,
        //           "dts": "2017-05-05T14:52:16+07:00",
        //           "s": 21,
        //           "sts": 0,
        //           "t": 4205,
        //           "v": "53N3327"
        //         }
        //       ],
        //       "r": 40,
        //       "rN": "Bến Thành - Chợ Hiệp Thành",
        //       "rNo": "18",
        //       "s": 199,
        //       "sN": "[Q1 076] Chùa Ông",
        //       "v": 80,
        //       "vN": "Bến Thành"
        //     },
        //     {
        //       "arrs": [
        //         {
        //           "d": 582.70730707523273,
        //           "dts": "2017-05-05T14:52:01+07:00",
        //           "s": 14,
        //           "sts": 0,
        //           "t": 128,
        //           "v": "51B21809"
        //         },
        //         {
        //           "d": 1726.4347459190881,
        //           "dts": "2017-05-05T14:52:08+07:00",
        //           "s": 0,
        //           "sts": 0,
        //           "t": 417,
        //           "v": "51B21920"
        //         }
        //       ],
        //       "r": 57,
        //       "rN": "Bến Thành - Thới An",
        //       "rNo": "36",
        //       "s": 199,
        //       "sN": "[Q1 076] Chùa Ông",
        //       "v": 114,
        //       "vN": "Bến Thành"
        //     }
        //   ]';


        $stringHTML = '<div class="title">List of incoming bus</div>';

        foreach ($arr_useable_route as $key => $value) {
          $min_d = $value->arrs['0']->d;
          $min_key = 0;
          
          foreach ($value->arrs as $k => $v) {
            if($v->d < $min_d) {
              $min_d = $v->d;
              $min_key = $k;
            }
          }

          $stringHTML .= '<div class="bus">' .
          '<b>* Route: </b>'.$value->rNo .'<br>' .
          '<b class="sub-root">- License Plates: </b> '.$value->arrs[$min_key]->v.' <br>' .
          '<b class="sub-chil">Distance: </b> '.$value->arrs[$min_key]->d.'m <br>' .
          '<b class="sub-chil">Speed: </b> '.$value->arrs[$min_key]->s.'km/h <br>' .
          '<b class="sub-chil">Coming in: </b> '.$value->arrs[$min_key]->dts.' <br>' .
          '</div>';

        }
      
        
    $data = array(
        'status'    => true,
        'data'      => $stringHTML
    );

} else {
    $message = 'Missing argument';

    $data = array(
        'status'    => $status,
        'message'   => $message
    );
}

echo json_encode($data);
?>