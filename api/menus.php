<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../model/humapub.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Menu Query
$result = $post->get_menus();

// Get Row Count
$num = $result->rowCount();

// Check if any records
if($num > 0) {
    $menus = [];
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $menu_item = [
            'mnutbl_mid' => $mnutbl_mid,
            'mnutbl_orderid' => $mnutbl_orderid,
            'mnutbl_positionname' => $mnutbl_positionname,
            'mnutbl_itemname' => $mnutbl_itemname,
            'mnutbl_itemlink' => $mnutbl_itemlink,
            'mnutbl_parentid' => $mnutbl_parentid,
            'mnutbl_onpage' => $mnutbl_onpage,
            'mnutbl_status' => $mnutbl_status 
        ];

        array_push($menus, $menu_item);
    }

    print_r(json_encode($menus));

} else {
    print_r(json_encode(['message'=>'no post found']));
}


?>