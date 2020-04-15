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
include_once '../../models/Bet.php';

$database = new Database();

$db = $database->connect();

$bet = new Bet($db);

//GET THE RAW POSTED DATA
$data = json_decode(file_get_contents("php://input"));

$bet->BetterNick = $data->BetterNick;
$bet->MatchName = $data->MatchName;
// $bet->BetterID = $data->BetterID;
// $bet->MatchID = $data->MatchID;
$bet->GoalsHomeBet = $data->GoalsHomeBet;
$bet->GoalsAwayBet = $data->GoalsAwayBet;
$bet->WinningTeamBet = $data->WinningTeamBet;
// $bet->LiveBetPoints = $data->LiveBetPoints;
// $bet->LiveBetPointsWinning = $data->LiveBetPointsWinning;
// $bet->LiveBetPointsTotal = $data->LiveBetPointsTotal;

//CREATE BET
if($bet->create()) {
    echo json_encode(
        array('message' => 'Bet Created')
    );
} else {
    echo json_encode(
        array('message' => 'Bet Not Created')
    ); 
}

?>