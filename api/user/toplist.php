<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 
//FELHANTERING FRÅN ANDERS
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
date_default_timezone_set('Europe/Stockholm');

include_once '../../config/Database.php';
include_once '../../models/Toplist.php';

$database = new Database();

$db = $database->connect();

$user = new Toplist($db);

$result = $user->read();

$num = $result->rowCount();

if($num > 0){
    $users_arr = array();
    // $users_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_item = array(
            'BetterID' => $BetterID,
            'BetterNick' => $BetterNick,
            'TotPoints' => $TotPoints
        );

        array_push($users_arr, $user_item);
    }

    echo json_encode($users_arr);

} else {
    echo json_encode(
        array('message' => 'No Users Found')
    );
}

?>