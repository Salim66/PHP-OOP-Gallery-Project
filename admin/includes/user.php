<?php 


// Create user class
class User {

    // create class property
    protected static $db_table = "users";
    protected static $db_table_field = ["username", "password", "first_name", "last_name"];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name; 


    /**
     * Find all user from the database
     */
    public static function findAllUsers(){
        // global $database;

        // $result_set = $database->query("SELECT * FROM users");
        // return $result_set;

        return self::findThisQuery("SELECT * FROM users");
    }

    
    /**
     * Find specific user by user id
     */
    public static function findUserById($user_id){
        global $database;

        // $result_set = $database->query("SELECT * FROM users WHERE id=$user_id LIMIT 1");
        // $found_user = mysqli_fetch_array($result_set);
        // return $found_user;

        // use this way / this way to more short and clear cord
        $the_result_array = self::findThisQuery("SELECT * FROM users WHERE id= $user_id LIMIT 1");
        
        return !empty($the_result_array)? array_shift($the_result_array) : false;
    }

    
    /**
     * Find any query method
     */
    public static function findThisQuery($sql){
        global $database;

        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }

    
    /**
     * Auto instantiation method
     */
    public static function instantiation($found_user){
        $the_object = new self;

        // // more better this code below the code 
        // $the_object->id         = $found_user['id'];
        // $the_object->username   = $found_user['username'];
        // $the_object->password   = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name  = $found_user['last_name'];

        // this way more easy to understand and esay to assign
        foreach($found_user as $the_attribute => $value){

            if($the_object->hasTheAttribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }

        }

        return $the_object;
    }

    /**
     * Create method has or not attribute 
     */
    private function hasTheAttribute($the_attribute){
        // get this class properties
        $object_properties = get_object_vars($this);
        // check array key exist or not
        return array_key_exists($the_attribute, $object_properties);
    }

    /**
     * Create abstracting method
     */
    protected function properties(){
        // return get_object_vars($this);

        $properties = [];

        foreach(self::$db_table_field as $db_field){
            // chcek class property exists this array property 
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }


    /**
     * User verify from the database
     */
    public static function verify_user($username, $password){
        // before we sending data into database first we clean up the string / unnessary token and symbol
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

         // use this way / this way to more short and clear cord
         $the_result_array = self::findThisQuery($sql);
         return !empty($the_result_array)? array_shift($the_result_array) : false;

    }


    /**
     * Create save method to improve our create and update method
     */
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }


    /**
     * User Store method
     */
    public function create(){
        global $database;

        // call to abstract method this method hold all the propertis
        $properties = $this->properties();
        // create query
        $sql = "INSERT INTO ".self::$db_table."(". implode(",", array_keys($properties)) .") ";
        $sql .= "VALUES('".implode("','", array_values($properties))."')";


        // check whether the query successfully store or not
        if($database->query($sql)){
            $this->id = $database->theInsertId(); // return the inserted last id
            return true;
        }else {
            return false;
        }
    }

    /**
     * User Update Method
     */
    public function update(){
        global $database;

        // call to abstract method this method hold all the propertis
        $properties = $this->properties();
        
        $properties_pairs = [];

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}= '{$value}'";
        }


        // update query
        $sql = "UPDATE ".self::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= '".$database->escape_string($this->id)."' ";

        // execute the query
        $database->query($sql);
        // check whether the update query successfully affected or not
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    /**
     * User Delete Method
     */
    public function delete(){
        global $database;
        // delete query
        $sql = "DELETE FROM ".self::$db_table." ";
        $sql .= "WHERE id= " .$database->escape_string($this->id);
        $sql .= " LIMIT 1";

        // execute the query
        $database->query($sql);

        // check whether the delete successfully affected or not
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }


}