<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, AUthorization, X-Requested-With');

 
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

//GET THE RAW POSTED DATA
$data = json_decode(file_get_contents("php://input"));

$test->TestID = $data->TestID;
$test->TestName = $data->TestName;

//CREATE GAME
if($test->create()) {
    echo json_encode(
        array('message' => 'Test Created')
    );
} else {
    echo json_encode(
        array('message' => 'Test Not Created')
    ); 
}