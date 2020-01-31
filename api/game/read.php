<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Game.php';

$database = new Database();

$db = $database->connect();

$game = new Game($db);

$result = $game->read();

$num = $result->rowCount();

if($num > 0){
    $games_arr = array();
    $games_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $game_item = array(
            'MatchID' => $matchid,
            'MatchName' => $matchname
        );

        array_push($games_arr['data'], $game_item);
    }

    echo json_encode($games_arr);

} else {
    echo json_encode(
        array('message' => 'No Games Found')
    );
}

?>
