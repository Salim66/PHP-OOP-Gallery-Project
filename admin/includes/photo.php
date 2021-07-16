<?php 

// Create photo class
class Photo extends DBObject {

    // create class property
    protected static $db_table = "photos";
    protected static $db_table_field = ["photo_id", "title", "description", "filename", "type", "size"];
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size; 


    public $tmp_path;
    public $upload_directory = "images";
    public $errors = [];

    public $upload_errors_array = [

        UPLOAD_ERR_OK		    => "There is no error", // 0
        UPLOAD_ERR_INI_SIZE	    => "The uploaded file exceds the upload_max_filesize", // 1
        UPLOAD_ERR_FORM_SIZE	=> "The uploaded file exceeds the MAX_FILE_SIZE directive", // 2
        UPLOAD_ERR_PARTIAL	    => "The uploaded file was only partially uploaded.", // 3
        UPLOAD_ERR_NO_FILE	    => "No file was uploaded.", // 4
        UPLOAD_ERR_NO_TMP_DIR	=> "Missing a temporary folder", // 6
        UPLOAD_ERR_CANT_WRITE	=> "Failed to write file to disk", // 7
        UPLOAD_ERR_EXTENSION	=> "A PHP extension stopped the file upload." // 8

    ];




    // This is passing $_FILES['upload_file'] as an argument
    public function setFile($file){

        if(empty($file) || !$file || !is_array($file)){
            
            $this->errors[] = "There was no file uploaded here";
            return false; 

        }elseif($file['error'] != 0){

            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;

        }else {

            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tem_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];

        }
    }



}





?>