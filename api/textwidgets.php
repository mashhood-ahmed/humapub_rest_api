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

  $post->tag = (isset($_GET['tag'])) ? $_GET['tag'] : die();
  $result = $post->get_text_widgets();
  $num = $result->rowCount();

  if($num > 0) {

    $txt_wid = [];
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $data = [
        'pgtbl_content_id' => $row['pgtbl_content_id'],
        'pgtbl_order_id' => $row['pgtbl_order_id'],
        'pgtbl_content_title' => $row['pgtbl_content_title'],
        'pgtbl_content_text' => $row['pgtbl_content_text'],
        'pgtbl_short_description_eng' => $row['pgtbl_short_description_eng'],
        'pgtbl_content_link_text' => $row['pgtbl_content_link_text'],
        'pgtbl_content_link' => $row['pgtbl_content_link'],
        'pgtbl_content_picture' => $row['pgtbl_content_picture'],
        'pgtbl_featured' => $row['pgtbl_featured'],
        'pgtbl_type'=> $row['pgtbl_type'],
        'pgtbl_tags' => $row['pgtbl_tags']
    ];

    array_push($txt_wid, $data);
    print_r(json_encode($txt_wid));
  
 } else {
     print_r(json_encode(['message'=>'no post found']));
 }




?>
