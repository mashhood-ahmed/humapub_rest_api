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

  /** Get Data */
  if(isset($_GET['volumn']) && isset($_GET['issueid']) && isset($_GET['year'])) {
    $post->volumn = $_GET['volumn'];
    $post->issue_id = $_GET['issueid'];
    $post->iss_year = $_GET['year'];
  } else {
    die();
  }

  // Get post
  $result = $post->read();

   // Get row count
   $num = $result->rowCount();

   // Check if any posts
   if($num > 0) {
     // Post array
     $posts_arr = array();
     // $posts_arr['data'] = array();
 
     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       extract($row);
 
       $post_item = array(
        'pprtbl_pprid' => $pprtbl_pprid,
        'pprtbl_orderid' => $pprtbl_orderid,
        'pprtbl_pprtitle' => $pprtbl_pprtitle ,
        'pprtbl_pprurl' => $pprtbl_pprurl,
        'pprtbl_turscore' => $pprtbl_turscore,
        'pprtbl_description' => $pprtbl_description,
        'pprtbl_pagenos' => $pprtbl_pagenos,
        'pprtbl_firstfilepath' => $pprtbl_firstfilepath,
        'pprtbl_filepath' => $pprtbl_filepath,
        'pprtbl_InitialFile' => $pprtbl_InitialFile,
        'pprtbl_galleyfilepath' => $pprtbl_galleyfilepath,
        'pprtbl_turpath' => $pprtbl_turpath,
        'pprtbl_inskey' => $pprtbl_inskey,
        'pprtbl_featured' => $pprtbl_featured,
        'pprtbl_keywords' => $pprtbl_keywords,
        'pprtbl_doistatus' => $pprtbl_doistatus,
        'pprtbl_demensionsid' => $pprtbl_demensionsid,
        'pprtbl_views' => $pprtbl_views,
        'pprtbl_dnlds' => $pprtbl_dnlds,
        'pprtbl_crcitations' => $pprtbl_crcitations,
        'pprtbl_gscitations' => $pprtbl_gscitations,

        'submtbl_subid' => $submtbl_subid ,
        'submtbl_paperid' => $submtbl_paperid,
        'submtbl_issueid' => $submtbl_issueid,
        'submtbl_scopeid' => $submtbl_scopeid,
        'submtbl_discid' => $submtbl_discid,
        'submtbl_subjid' => $submtbl_subjid,
        'submtbl_fieldid' => $submtbl_fieldid,
        'submtbl_userid' => $submtbl_userid,
        'submtbl_subdate' => $submtbl_subdate,
        'submtbl_subtime' => $submtbl_subtime,
        'submtbl_volume' => $submtbl_volume,
        'submtbl_issue' => $submtbl_issue,
        'submtbl_season' => $submtbl_season,
        'submtbl_year' => $submtbl_year,
        'submtbl_status' => $submtbl_status,

        'fgtbl_fno' => $fgtbl_fno ,
        'fgtbl_pprid' => $fgtbl_pprid ,
        'fgtbl_text' => $fgtbl_text,
        'fgtbl_folder' => $fgtbl_folder,
        'fgtbl_imgname' => $fgtbl_imgname,
        'fgtbl_status' => $fgtbl_status,

        'prftbl_rno' => $prftbl_rno,
        'prftbl_ordid' => $prftbl_ordid,
        'prftbl_pprid' => $prftbl_pprid,
        'prftbl_rtext' => $prftbl_rtext,
        'prftbl_rlink' => $prftbl_rlink,
        'prftbl_status' => $prftbl_status,

        'authtbl_authid' => $authtbl_authid ,
        'authtbl_pprid' => $authtbl_pprid,
        'authtbl_orderid' => $authtbl_orderid,
        'authtbl_corres_auth' => $authtbl_corres_auth	,
        'authtbl_fname' => $authtbl_fname,
        'authtbl_mname' => $authtbl_mname,
        'authtbl_lname' => $authtbl_lname,
        'authtbl_affiliation' => $authtbl_affiliation,
        'authtbl_contact' => $authtbl_contact,
        'authtbl_email' => $authtbl_email,

        'isstbl_issueno' => $isstbl_issueno ,
        'isstbl_volno' => $isstbl_volno,
        'isstbl_issno' => $isstbl_issno,
        'isstbl_iss_season' => $isstbl_iss_season,
        'isstbl_iss_year' => $isstbl_iss_year,
        'isstbl_iss_month' => $isstbl_iss_month,
        'isstbl_published_date' => $isstbl_published_date	,
        'isstbl_picpath' => $isstbl_picpath,
        'isstbl_picpath2' => $isstbl_picpath2,
        'isstbl_status' => $isstbl_status,
        'isstbl_featured' => $isstbl_featured,

        'pstbl_sno' => $pstbl_sno,
        'fgtbl_ordid' => $fgtbl_ordid,
        'ffgtbl_pprid' => $fgtbl_pprid,
        'pstbl_text' => $pstbl_text,
        'pstbl_link' => $pstbl_link,
        'pstbl_status' => $pstbl_status

       );
 
       // Push to "data"
       array_push($posts_arr, $post_item);
       // array_push($posts_arr['data'], $post_item);
     }
 
     // Turn to JSON & output
     echo json_encode($posts_arr);
 
   } else {
     // No Posts
     echo json_encode(
       array('message' => 'No Posts Found')
     );

    }