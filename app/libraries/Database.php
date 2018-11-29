<?php
  /*
   * PDO Database Class
   * Use MysqliDb library by Josh Cam
   * Connect to database
   * Create prepared statements
   * Bind values
   * Return rows and results
   */
  class Database extends MysqliDb{
    /**
     * Summary of $host
     * @var string
     */
    private $host   =   DB_HOST;
    /**
     * @var string
     */
    private $user   =   DB_USER;
    /**
     * @var string
     */
    private $pass   =   DB_PASS;
    /**
     * @var string
     */
    private $dbname =   DB_NAME;

    /**
     * Static instance of self
     * @var MysqliDb
     */
    private static $dbh;
    /**
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $db
     */
    public function __construct(){
      parent::__construct($this->host, $this->user, $this->pass, $this->dbname);
    }

    /**
     * Static instance of self
     * @return MysqliDb
     */
    public static function getDbh() {
      if(is_null(self::$dbh)) {
         self::$dbh = new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      }
      return self::$dbh;
    }
  }
