<?php 

// Create photo class
class Photo extends DBObject {

    // create class property
    protected static $db_table = "photos";
    protected static $db_table_field = ["id", "title", "caption", "description",  "alternate_text", "filename", "type", "size"];
    public $id;
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
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];

        }
    }



    // Create save method
    public function save(){
        
        // check whether the id has or not
        if($this->id){
            $this->update();
        }else {

            // Check $errors is not empty
            if(!empty($this->errors)){
                return false;
            }

            // Check whether the filename and tmp_name is empty
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = 'The file was not available';
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            // check whether the file already has 
            if(file_exists($target_path)){
                $this->errors[] = 'The file {$this->filename} already exists';
                return false;
            }

            // upload a file
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }else {
                $this->errors[] = 'The file directory probabily does not have permission';
                return false;
            }

        }

    }


    

    //Create method for path file path directory
    public function picturePath(){
        return $this->upload_directory.DS.$this->filename;
    }



    // Delete photo
    public function deletePhoto(){
        if($this->delete()){
            $target_path = SITE_ROOT . DS . 'admin' . $this->picturePath();
            return unlink($target_path) ? true : false;
        }else {
            return false;
        }
    }


    // Sidebar data
    public static function displaySidebarData($photo_id){
        $photo = Photo::findById($photo_id);

        $output  = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picturePath()}'></a>";
        $output .= "<p>{$photo->filename}</p>";
        $output .= "<p>{$photo->type}</p>";
        $output .= "<p>{$photo->size}</p>";

        echo $output;
    }


}





?>