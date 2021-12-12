<?php

class Upload {
    protected $uploadDir;
    protected $defaultUploadDir = 'uploads';
    public $file;
    public $fileName;
    public $filePath;
    protected $rootDir;
    protected $errors = [];

    protected function validate() {
        if(!$this->isSizeAllowed()){
            array_push($this->errors, 'size is bigger than allowed');
        }elseif(!$this->isMimeAllowed()){
            array_push($this->errors, 'the type not allowed');
        }

        return $this->errors;
        
    }

    protected function createUploadDir(){
        if(!is_dir($this->uploadDir)){
            umask(0);
            if(!mkdir($this->uploadDir, 0775)){
                array_push($this->errors, 'We could make a dir');
                return false;
            }
        }

        return true;
    }

    public function upload(){
    
            $this->fileName = time().$this->file['name'];
            $this->filePath .= '/'.$this->fileName;
    
            if($this->validate()){
                return $this->errors;
            }elseif(!$this->createUploadDir()){
                return $this->errors;
            }elseif(!move_uploaded_file($this->file['tmp_name'] , $this->uploadDir.'/'.$this->fileName)){
                array_push($this->errors, 'Error in handle your file');
            };
            return $this->errors;
        }

    public function __construct($uploadDir , $rootDir = false) {

        if($rootDir){
            $this->rootDir = $rootDir;
        }else{
            $this->rootDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'firstPhpCode';
        }

        $this->filePath = $uploadDir;
        $this->uploadDir = $this->rootDir.'/'.$uploadDir;

    }

    protected function isMimeAllowed() {
        $allowed = [
            "jpg" => "image/jpeg" , 
            "png" => "image/png" , 
            "gif" => "image/gif" , 

        ];

        $fileType = mime_content_type($this->file['tmp_name']);

        if(!in_array($fileType, $allowed)){
            return false;
            
        };

        return true;
    }

  

    protected function isSizeAllowed(){
        $maxSize = 10 * 1024 * 1024;
        $fileSize = $this->file['size'];

        if($fileSize > $maxSize){
            return false;
        }

        return true;
    }


}