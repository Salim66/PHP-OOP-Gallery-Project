<?php 


// Create user class
class User {


    /**
     * Find all user from the database
     */
    public static function findAllUsers(){
        global $database;

        $result_set = $database->query("SELECT * FROM users");
        return $result_set;
    }

    
    /**
     * Find specific user by user id
     */
    public static function findUserById($user_id){
        global $database;

        $result_set = $database->query("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;
    }


}