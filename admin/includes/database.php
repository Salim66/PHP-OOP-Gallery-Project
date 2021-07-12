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
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // check whether the database connect or failed
        if(mysqli_connect_errno()){
            die('Database connection failed badly' . mysqli_error() );
        }
    }


    // create query method
    public function query($sql){
        
        $result = mysqli_query($this->connection, $sql);

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
        $escape_string = mysqli_real_escape_string($this->connection, $string);
        return $escape_string;
    }

    
}

// create database class instance
$database = new Database();


// $database->open_db_connection(); // do not need because database atuomatic connection, we call this function into constructor