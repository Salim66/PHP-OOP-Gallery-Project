<?php 


// Create user class
class User extends DBObject {

    // create class property
    protected static $db_table = "users";
    protected static $db_table_field = ["username", "password", "first_name", "last_name"];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name; 






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
     * Create clean properties abstraction method
     */
    protected function clean_properties(){
        global $database;

        $clean_properties = [];

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }





    /**
     * User verify from the database
     */
    public static function verify_user($username, $password){
        // before we sending data into database first we clean up the string / unnessary token and symbol
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " .self::$db_table. " WHERE ";
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
        $properties = $this->clean_properties();
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
        $properties = $this->clean_properties();
        
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