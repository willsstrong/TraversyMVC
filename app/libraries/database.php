<?php

/**
 * PDO DAtabase Class
 * Connect to database
 * Create prepared statements
 * Bind Values
 * Return Rows and results
 */

class Database{

  // Credentials defined in config.php.
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $dbHandler;
  private $sqlStatement;
  private $errorMsg;

  public function __construct()
  {
    //set DSN
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

    );

    //Create DPO Instance
// Create PDO instance
      try{
        $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
      } catch(PDOException $e){
        $this->errorMsg = $e->getMessage();
        echo $this->errorMsg;
      }
  }
  //Prepate Query Statement
  public function query($sql){
    $this->sqlStatement = $this->dbHandler->prepare($sql);
  }

  //Bind values;
  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->sqlStatement->bindValue($param, $value, $type);
  }

  //Execute the prepared sql statement
  public function execute()
  {
    return $this->sqlStatement->execute();
  }

  //Get -all- query results
  public function resultSet() {
    $this->execute();
    return $this->sqlStatement->fetchAll(PDO::FETCH_OBJ);
  }

  //Get -single- record
  public function single() {
    $this->execute();
    return $this->sqlStatement->fetch(PDO::FETCH_OBJ);
  }

  //Get row count
  public function rowCount()
  {
    return $this->sqlStatement->rowCount();
  }
}