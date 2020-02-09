<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 
// //FELHANTERING FRÅN ANDERS
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
// date_default_timezone_set('Europe/Stockholm');

include_once '../../config/Database.php';
include_once '../../models/Test.php';

$database = new Database();

$db = $database->connect();

$test = new Test($db);

$result = $test->read();

$num = $result->rowCount();

if($num > 0){
    $tests_arr = array();
    // $games_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $test_item = array(
            'TestID' => $TestID,
            'TestName' => $TestName
        );

        array_push($tests_arr, $test_item);
    }

    echo json_encode($tests_arr);

} else {
    echo json_encode(
        array('message' => 'No Tests Found')
    );
}

?>