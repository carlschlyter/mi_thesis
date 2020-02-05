<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 
//FELHANTERING FRÅN ANDERS
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
date_default_timezone_set('Europe/Stockholm');

include_once '../../config/Database.php';
include_once '../../models/Game.php';

$database = new Database();

$db = $database->connect();

$game = new Game($db);

$result = $game->read();

$num = $result->rowCount();

if($num > 0){
    $games_arr = array();
    // $games_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $game_item = array(
            'MatchID' => $MatchID,
            'MatchName' => $MatchName,
            'MatchDate' => $MatchDate,
            'Status' => $Status
        );

        array_push($games_arr, $game_item);
    }

    echo json_encode($games_arr);

} else {
    echo json_encode(
        array('message' => 'No Games Found')
    );
}

?>
