<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../apiModels/Advert.php';

$database = new Database();
$db = $database->connect();

$advert = new Advert($db);
$advert->id = isset($_GET['id']) ? $_GET['id'] : die();

$row = $advert->get_item();

if (isset($row['title'])) {
    $advert_arr = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'price' => $row['price'],
    );

    if (isset($_GET['fields'])) {
        $fields = explode(',', $_GET['fields']);
        if (in_array('descr', $fields)) $advert_arr+=array('descr'=>$row['descr']);
        if (in_array('photo', $fields)) $advert_arr+=array('photo'=>$row['photo']);
    }

    print_r(json_encode($advert_arr));
}
else {
    http_response_code(404);
    echo json_encode(array("error" => "No adv."));
}