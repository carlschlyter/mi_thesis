<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Bet_options.php';

$database = new Database();
$db = $database->connect();

$betOptions = new Bet_options($db);

$matches = $betOptions->view();

$num = $matches->rowCount();

if($num > 0) {
    $betOptions_arr = array();
    $betOptions_arr['data'] = array();

    while($row = $matches->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $betOption_item = array(
            'MatchID' => $matchid,
            'MatchName' => $matchname,
            'MatchDate' => $matchdate,
            'Status' => $status
        );

        array_push($betOptions_arr['data'], $betOption_item);
    }

    //Turn JSON and ouput
    echo json_encode($betOptions_arr);

} else {

    //If no bet options in table
    echo json_encode(
        array('message' => 'No Bet Options right now')
    );
}