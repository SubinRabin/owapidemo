<?php
if (isset($_REQUEST['hotel_id']) && isset($_REQUEST['token']) ) {
   $dd=  authMethod();
   $dd = json_decode($dd);
   if (isset($dd->token)) {
       $res = hotelbookmethod($dd->token);
       $res = json_decode($res);
   }
}
function authMethod() {
    $curl = curl_init();
    $url = 'https://sandbox-authapi.otelseasy.com/v1';
    $auth = array(
        'Agent_Code' => 'ABCDEF',
        'Username' => 'sanbox-user',
        'password' => 'pa$$word',
    );
    $data = json_encode($auth);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function hotelbookmethod($token) {
    $curl = curl_init();
    $url = 'https://sandbox-hotelbookapi.otelseasy.com/v1';
    $roomindex = array();
    $auth = array(
        'token' => $_REQUEST['token'],
        'hotelcode' => $_REQUEST['hotel_id'],
        'RoomIndex' => $_REQUEST['RoomIndex'],
    );
    $room = array();
    for($i=1;$i<=$_REQUEST['no_of_rooms'];$i++) {
		for($j=0;$j<$_REQUEST['Room'.$i.'adults'];$j++) {
                $auth['Room'.$i.'AdultTitle'][$j] = $_REQUEST['Room'.$i.'Adulttitle'][$j];
                $auth['Room'.$i.'AdultFirstname'][$j] = $_REQUEST['Room'.$i.'AdultFirstName'][$j];
                $auth['Room'.$i.'AdultLastname'][$j] = $_REQUEST['Room'.$i.'AdultLastName'][$j];
				$auth['Room'.$i.'AdultAge'][$j] = $_REQUEST['Room'.$i.'AdultAge'][$j]!="" ? $_REQUEST['Room'.$i.'AdultAge'][$j] : 22;
		}
    }
    $data = json_encode($auth);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'authorization: Bearer  '.$token.'',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($curl);
    curl_close($curl);
    echo "<br>";
    echo "<br>";
    echo "<br>";
    print_r($result);
    return $result;
}

?>