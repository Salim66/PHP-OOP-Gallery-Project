<?php 

// require congig file
require_once("config.php");

class Database {

    // create public property
    public $connection;
    public $db;


    // create constructor because we need to automatic connection to database 
    function __construct()
    {
        $this->db = $this->open_db_connection();
    }

    // database connection
    public function open_db_connection(){
        // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // check whether the database connect or failed
        if($this->connection->connect_errno){
            die('Database connection failed badly' . $this->connection->connect_errno );
        }

        return $this->connection;
    }


    // create query method
    public function query($sql){
        
        // $result = mysqli_query($this->connection, $sql);
        $result = $this->db->query($sql);

        $this->confirm_query($result);

        return $result;

    }


    /**
     * Create a helper method
     */
    private function confirm_query($result){
        // check whether the query success or not
        if(!$result){
            die("Query Failed" . $this->db->error);
        }
    }


    /**
     * Helper Method
     * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
     */
    public function escape_string($string){
        // $escape_string = mysqli_real_escape_string($this->connection, $string);
        $escape_string = $this->db->real_escape_string($string);
        return $escape_string;
    }


    /**
     * get insert last id 
     */
    public function theInsertId(){
        return mysqli_insert_id($this->db); // Returns the auto generated id used in the last query
    }

    
}

// create database class instance
$database = new Database();


// $database->open_db_connection(); // do not need because database atuomatic connection, we call this function into constructor