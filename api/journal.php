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
  
  // Get Settings Query
  $result = $post->get_settings();

  // Get Row Count
  $num = $result->rowCount();
  
  if($num > 0) {

    $sett_arr = [];
    $row = $result->fetch(PDO::FETCH_ASSOC);

    $data = [
        'settbl_setid'=>$row['settbl_setid'],
        'settbl_defemail'=>$row['settbl_defemail'],
        'settbl_sitename'=>$row['settbl_sitename'],
        'settbl_sitetitle'=>$row['settbl_sitetitle'],
        'settbl_short_title'=>$row['settbl_short_title'],
        'settbl_logo'=>$row['settbl_logo'],
        'settbl_logo2'=>$row['settbl_logo2'],
        'settbl_sup_succ_msg'=>$row['settbl_sup_succ_msg'],
        'settbl_verif_succ_msg'=>$row['settbl_verif_succ_msg'],
        'settbl_vlink_expired_msg'=>$row['settbl_vlink_expired_msg'],
        'settbl_oathtaking'=>$row['settbl_oathtaking'],
        'settbl_policystatement'=> $row['settbl_policystatement'],
        'settbl_acknowledgment'=>$row['settbl_acknowledgment'],
        'settbl_articleacceptance'=>$row['settbl_articleacceptance'],
        'settbl_fbadd'=>$row['settbl_fbadd'],
        'settbl_youtube'=>$row['settbl_youtube'],
        'settbl_twitter'=>$row['settbl_twitter'],
        'settbl_linkdin'=>$row['settbl_linkdin'],
        'settbl_instagram'=>$row['settbl_instagram'],
        'settbl_blog'=>$row['settbl_blog'],
        'settbl_pinterest'=>$row['settbl_pinterest'],
        'settbl_phone'=>$row['settbl_phone'],
        'settbl_faxc'=>$row['settbl_faxc'],
        'settbl_mobile'=>$row['settbl_mobile'],
        'settbl_gplus'=>$row['settbl_gplus'],
        'settbl_tumblr'=>$row['settbl_Tumblr'],
        'settbl_reddit'=>$row['settbl_Reddit'],
        'settbl_meetup'=>$row['settbl_MeetUp'],
        'settbl_fickr'=>$row['settbl_Fickr'],
        'settbl_vk'=>$row['settbl_VK'],
        'settbl_askfm'=>$row['settbl_AskFM'],
        'settbl_address'=>$row['settbl_address'],
        'settbl_address2'=>$row['settbl_address2'],
        'settbl_about'=>$row['settbl_about'],
        'settbl_issnprint'=>$row['settbl_issnprint'],
        'settbl_issnonline'=>$row['settbl_issnonline'],
        'settbl_issnlink'=>$row['settbl_issnlink'],
        'settbl_hits'=>$row['settbl_hits'],
        'settbl_dbtype'=>$row['settbl_dbtype'],
        'settbl_devnotes'=>$row['settbl_devnotes']
    ];

    array_push($sett_arr, $data);
    print_r(json_encode($sett_arr));
  
 } else {
     print_r(json_encode(['message'=>'no journal found']));
 }


?>