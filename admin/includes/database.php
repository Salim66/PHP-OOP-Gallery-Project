<?php 

// require congig file
require_once("config.php");

class Database {

    // create private property
    private $connection;

    public function open_db_connection(){
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // check whether the database connect or failed
        if(mysqli_connect_errno()){
            die('Database connection failed badly' . mysqli_error() );
        }
    }
}

// create database class instance
$database = new Database();
$database->open_db_connection();