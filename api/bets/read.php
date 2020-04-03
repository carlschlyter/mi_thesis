<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 
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

$result = $bet->read();

$num = $result->rowCount();

if($num > 0){
    $bets_arr = array();
    // $games_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $bet_item = array(
            'MatchID' => $MatchID,            
            'MatchName' => $MatchName,
            'MatchDate' => $MatchDate,
            'GoalsHomeBetAvg' => $GoalsHomeBetAvg,
            'GoalsAwayBetAvg' => $GoalsAwayBetAvg
        );

        array_push($bets_arr, $bet_item);
    }

    echo json_encode($bets_arr);

} else {
    echo json_encode(
        array('message' => 'No Bets Found')
    );
}

?>