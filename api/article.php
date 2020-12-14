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

  // Get URL
  $post->url = isset($_GET['url']) ? $_GET['url'] : die();

  // Get post
  $result = $post->read_single();
  $num = $result->rowCount();

  if($num > 0) {

    $records = [];
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Create array
    $post_arr = array(
    /*paper table*/
    'pprtbl_pprid' => $row['pprtbl_pprid'],
    'pprtbl_orderid'=> $row['pprtbl_orderid'],
    'pprtbl_pprtitle'=> $row['pprtbl_pprtitle'],
    'pprtbl_pprurl'=> $row['pprtbl_pprurl'],
    'pprtbl_turscore'=> $row['pprtbl_turscore'],
    'pprtbl_description'=> $row['pprtbl_description'],
    'pprtbl_pagenos'=> $row['pprtbl_pagenos'],
    'pprtbl_firstfilepath'=> $row['pprtbl_firstfilepath'],
    'pprtbl_filepath'=> $row['pprtbl_filepath'],
    'pprtbl_InitialFile'=> $row['pprtbl_InitialFile'],
    'pprtbl_galleyfilepath'=> $row['pprtbl_galleyfilepath'],
    'pprtbl_turpath'=> $row['pprtbl_turpath'],
    'pprtbl_inskey'=> $row['pprtbl_inskey'],
    'pprtbl_featured'=> $row['pprtbl_featured'],
    'pprtbl_keywords'=> $row['pprtbl_keywords'],
    'pprtbl_doistatus'=> $row['pprtbl_doistatus'],
    'pprtbl_demensionsid'=> $row['pprtbl_demensionsid'],
    'pprtbl_views'=> $row['pprtbl_views'],
    'pprtbl_dnlds'=> $row['pprtbl_dnlds'],
    'pprtbl_crcitations'=> $row['pprtbl_crcitations'],
    'pprtbl_gscitations'=> $row['pprtbl_gscitations'],
    /*submission table*/
    'submtbl_subid'=> $row['submtbl_subid'],
    'submtbl_paperid'=> $row['submtbl_paperid'],
    'submtbl_issueid'=> $row['submtbl_issueid'],
    'submtbl_scopeid'=> $row['submtbl_scopeid'],
    'submtbl_discid'=> $row['submtbl_discid'],
    'submtbl_subjid'=> $row['submtbl_subjid'],
    'submtbl_fieldid'=> $row['submtbl_fieldid'],
    'submtbl_userid'=> $row['submtbl_userid'],
    'submtbl_subdate'=> $row['submtbl_subdate'],
    'submtbl_subtime'=> $row['submtbl_subtime'],
    'submtbl_volume'=> $row['submtbl_volume'],
    'submtbl_issue'=> $row['submtbl_issue'],
    'submtbl_season'=> $row['submtbl_season'],
    'submtbl_year'=> $row['submtbl_year'],
    'submtbl_status'=> $row['submtbl_status'],
    /** figures */
    'fgtbl_fno'=> $row['fgtbl_fno'],
    'fgtbl_pprid'=> $row['fgtbl_pprid'],
    'fgtbl_text'=> $row['fgtbl_text'],
    'fgtbl_folder'=> $row['fgtbl_folder'],
    'fgtbl_imgname'=> $row['fgtbl_imgname'],
    /**references table */
    'prftbl_rno'=> $row['prftbl_rno'],
    'prftbl_ordid'=> $row['prftbl_ordid'],
    'prftbl_pprid'=> $row['prftbl_pprid'],
    'prftbl_rtext'=> $row['prftbl_rtext'],
    'prftbl_rlink'=> $row['prftbl_rlink'],
    'prftbl_status'=> $row['prftbl_status'],
    'fgtbl_status' => $row['fgtbl_status'],
    /*authors table*/
    'authtbl_authid'=> $row['authtbl_authid'],
    'authtbl_pprid'=> $row['authtbl_pprid'],
    'authtbl_orderid'=> $row['authtbl_orderid'],
    'authtbl_corres_auth'=> $row['authtbl_corres_auth'],
    'authtbl_fname'=> $row['authtbl_fname'],
    'authtbl_mname'=> $row['authtbl_mname'],
    'authtbl_lname'=> $row['authtbl_lname'],
    'authtbl_affiliation'=> $row['authtbl_affiliation'],
    'authtbl_contact'=> $row['authtbl_contact'],
    'authtbl_email'=> $row['authtbl_email'],
    /**issue table */
    'isstbl_issueno'=> $row['isstbl_issueno'],
    'isstbl_volno'=> $row['isstbl_volno'],
    'isstbl_issno'=> $row['isstbl_issno'],
    'isstbl_iss_season'=> $row['isstbl_iss_season'],
    'isstbl_iss_year'=> $row['isstbl_iss_year'],
    'isstbl_iss_month'=> $row['isstbl_iss_month'],
    'isstbl_published_date'=> $row['isstbl_published_date'],
    'isstbl_picpath'=> $row['isstbl_picpath'],
    'isstbl_picpath2'=> $row['isstbl_picpath2'],
    'isstbl_status'=> $row['isstbl_status'],
    'isstbl_featured'=> $row['isstbl_featured'],
    /** section table */
    'pstbl_sno' => $row['pstbl_sno'],
    'fgtbl_ordid' => $row['fgtbl_ordid'],
    'ffgtbl_pprid' => $row['fgtbl_pprid'],
    'pstbl_text' => $row['pstbl_text'],
    'pstbl_link' => $row['pstbl_link'],
    'pstbl_status' => $row['pstbl_status'],
  );

  // Make JSON
  array_push($records, $post_arr);
  print_r(json_encode($records));

} else {
  print_r(json_encode(['message'=>'no post found']));
}