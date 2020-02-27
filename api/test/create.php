<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

// header('Content-Type:application/x-www-form-urlencoded');
// header('Content-Type: multipart/form-data');
// header('Content-Type: text/plain');
header('Access-Control-Request-Method: POST');
header('Access-Control-Request-Headers: Content-Type, X-PINGOTHER');
// header('Origin: http://localhost:3000');
// header('Accept: text/plain');

// header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
// header('Access-Control-Allow-Headers: *');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With, Origin, Cache-Control, Pragma, Accept, Accept-Encoding');
// header('Access-Control-Allow-Credentials: "true"');

 
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

//CREATE TEST
if($test->create()) {
    echo json_encode(
        array('message' => 'Test Created')
    );
} else {
    echo json_encode(
        array('message' => 'Test Not Created')
    ); 
}