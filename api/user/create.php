<?php
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, AUthorization, X-Requested-With');

 
//FELHANTERING FRÅN ANDERS
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
date_default_timezone_set('Europe/Stockholm');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();

$db = $database->connect();

$user = new User($db);

//GET THE RAW POSTED DATA
$data = json_decode(file_get_contents("php://input"));

// $user->UserID = $data->UserID;
$user->FirstName = $data->FirstName;
$user->LastName = $data->LastName;
$user->Email = $data->Email;
$user->UserName = $data->UserName;
$user->PassWord = $data->PassWord;
$user->City = $data->City;

//CREATE USER
if($user->create()) {
    echo json_encode(
        array('message' => 'User Created')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Created')
    ); 
}

?>