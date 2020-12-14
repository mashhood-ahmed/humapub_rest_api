<?php 
  class Post {
    // DB stuff
    private $conn;

    // parameters
    public $url;
    public $tag;
    public $volumn;
    public $issue_id;
    public $iss_year;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {

      // Create query  
      $query = 'SELECT * 
                FROM qlop_paper AS paper
                LEFT JOIN qlop_submission AS sub
                ON paper.pprtbl_pprid = sub.submtbl_paperid
                LEFT JOIN qlop_pprfigures AS fig
                ON paper.pprtbl_pprid = fig.fgtbl_pprid
                LEFT JOIN qlop_pprreferences AS ref
                ON paper.pprtbl_pprid = ref.prftbl_pprid
                LEFT JOIN qlop_authors AS author
                ON paper.pprtbl_pprid = author.authtbl_pprid
                LEFT JOIN qlop_pprsections AS section
                ON paper.pprtbl_pprid = section.fgtbl_pprid
                LEFT JOIN qlop_issues AS issue
                ON sub.submtbl_issueid = issue.isstbl_issueno
                WHERE issue.isstbl_issueno = ?
                AND issue.isstbl_volno = ?
                AND issue.isstbl_iss_year = ?'; 
                
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->issue_id);
        $stmt->bindParam(2, $this->volumn);
        $stmt->bindParam(3, $this->iss_year);

        // Execute query
        $stmt->execute();

        return $stmt;
    }



    // Get Single Post
    public function read_single() {

        // Create query
        $query = 'SELECT * 
                    FROM qlop_paper AS paper
                    LEFT JOIN qlop_submission AS sub
                    ON paper.pprtbl_pprid = sub.submtbl_paperid
                    LEFT JOIN qlop_pprfigures AS fig
                    ON paper.pprtbl_pprid = fig.fgtbl_pprid
                    LEFT JOIN qlop_pprreferences AS ref
                    ON paper.pprtbl_pprid = ref.prftbl_pprid
                    LEFT JOIN qlop_authors AS author
                    ON paper.pprtbl_pprid = author.authtbl_pprid
                    LEFT JOIN qlop_pprsections AS section
                    ON paper.pprtbl_pprid = section.fgtbl_pprid
                    LEFT JOIN qlop_issues AS issue
                    ON sub.submtbl_issueid = issue.isstbl_issueno
                    WHERE paper.pprtbl_pprurl = ?';  

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->url);

        // Execute query
        $stmt->execute();
        return $stmt;

    }
    
    // Get settings
    public function get_settings() {

      // create query
      $query = 'SELECT * FROM qlop_settings';

      // prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;

    }

    // Get TextWidgets
    public function get_text_widgets() {
      
      // create query
      $query = 'SELECT * FROM 
                jkoq_textwidgets AS tw
                WHERE tw.pgtbl_tags = ?';
      
      // prepare statement          
      $stmt = $this->conn->prepare($query);
      
      // bind parameters
      $stmt->bindParam(1, $this->tag);
      
      // execute query
      $stmt->execute();

      return $stmt;
      
    }

    // Get Menus
    public function get_menus() {
      // create query 
      $query = 'SELECT * FROM 
                qlop_menus';

      // prepare statement 
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();
      
      return $stmt;
    }

  }