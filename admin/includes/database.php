<?php 

// require congig file
require_once("config.php");

class Database {

    // create public property
    public $connection;


    // create constructor because we need to automatic connection to database 
    function __construct()
    {
        $this->open_db_connection();
    }

    // database connection
    public function open_db_connection(){
        // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // check whether the database connect or failed
        if($this->connection->connect_errno){
            die('Database connection failed badly' . $this->connection->connect_errno );
        }
    }


    // create query method
    public function query($sql){
        
        // $result = mysqli_query($this->connection, $sql);
        $result = $this->connection->query($sql);

        $this->confirm_query($result);

        return $result;

    }


    /**
     * Create a helper method
     */
    private function confirm_query($result){
        // check whether the query success or not
        if(!$result){
            die("Query Failed");
        }
    }


    /**
     * Helper Method
     * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
     */
    public function escape_string($string){
        // $escape_string = mysqli_real_escape_string($this->connection, $string);
        $escape_string = $this->connection->real_escape_string($string);
        return $escape_string;
    }


    /**
     * create insert id 
     */
    // public function theInsertId(){
    //     return $this->connection->insert_id;
    // }

    
}

// create database class instance
$database = new Database();


// $database->open_db_connection(); // do not need because database atuomatic connection, we call this function into constructor