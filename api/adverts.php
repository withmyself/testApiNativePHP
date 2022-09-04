<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../apiModels/Advert.php';

$database = new Database();
$db = $database->connect();

$advert = new Advert($db);

$query = "SELECT * FROM adv";

foreach ($_GET as $key => $value) {
    if ($key == 'desc' || $key == 'asc') {
        if ($value == 'price' || $value == 'created_at') {
            $query = $query . " ORDER BY " . $value . " " . $key;
            break;
        }
    }

}
$result = $advert->get_items($query);
$num = $result->rowCount();

if($num > 0){
    $advert_arr = array();
    $advert_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $advert_item = array(
            'id' => $id,
            'title' => $title,
            'price' => $price,
            'photo' => $photo,
        );
        array_push($advert_arr['data'], $advert_item);
    }
    echo json_encode($advert_arr);
}else{
    http_response_code(404);
    echo json_encode(array('error' => 'No advs.'));
}