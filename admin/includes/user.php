<?php 


// Create user class
class User {


    /**
     * Find all user from the database
     */
    public static function find_all_users(){
        global $database;

        $result_set = $database->query("SELECT * FROM users");
        return $result_set;
    }


}