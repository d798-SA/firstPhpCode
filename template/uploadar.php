<?php 
    require_once __DIR__ . '/../config/database.php';

    $uploadsDir = 'uploads';


    function filterString($field){
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);

        if(empty($field)){
            return false;
        }else{
            return $field;
        };

        
    };


    function filterEmail($field){
        $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);

        if(filter_var($field , FILTER_VALIDATE_EMAIL)){
            return $field;
        }else{
            return false;
        };
    };


    function canUpload($field){
        $allowed = [
            "jpg" => "image/jpeg" , 
            "png" => "image/png" , 
            "gif" => "image/gif" , 
            "mp4" => "video/mp4" ,
             "video" => "video/quicktime",
             "pdf" => "application/pdf"
        ];

        $fileType = mime_content_type($field['tmp_name']);
        $maxSize = 30 * 1024 * 1024;

        $fileSize = $field['size'];

        if(!in_array($fileType, $allowed)){
            return "the type is not allowed ";
            
        };

        return true;
    }

    $nameError = $emailError = $uploadFileError = $commentError = '';

    $valueName = $valueEmail = $valuecomment = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $valueName = filterString($_POST['valueName']);

   if(!$valueName){
      $nameError = 'this shouldn\'t be empty ';
   };


   $valueEmail = filterString($_POST['valueEmail']);

   if(!$valueEmail){
       $emailError = "this shouldn\'t be empty ";
   };

   

   $valuecomment = filterString($_POST['valuecomment']);


   if(!$valuecomment){
       $commentError = 'this shouldn\'t be empty ';
   };



   
  
    if(isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] == 0){
        
        if(canUpload($_FILES['uploadFile']) === true){

            if(!is_dir($uploadsDir)){

                umask(0);
                mkdir($uploadsDir , 0775);



            }else{
                $fileName = time().$_FILES['uploadFile']['name'];
                $target_file = $uploadsDir . '/' . basename($_FILES["uploadFile"]["name"]);


                move_uploaded_file($_FILES['uploadFile']['tmp_name'] , $target_file);

               
            }
        }else{
            $uploadFileError = canUpload($_FILES['uploadFile']);
        }
    };
    
    if(!$nameError && !$uploadFileError && !$emailError && !$commentError){

      

        if(empty($target_file)){
            $target_file = null;
        };

        $stmt = $conn->prepare("insert into messages(contact_name , contact_email , file , contact_message , services_id)

        values(?,?,?,?,?)");

        $stmt->bind_param("ssssi" , $valueName , $valueEmail , $target_file , $valuecomment , $_POST['Services']);
        $stmt->execute();

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'content-type: tex/html; charset=UFT-8' . "\r\n";
        $headers .= 'From: '. $valueEmail . "\r\n". 
        'Reply-to: '. $valueEmail . "\r\n".
        'X-Mailer: PHP/' . phpversion(); 
        
        $messagEm = '<html><body>';
        $messagEm .= '<p> style="color:#ff0000;" >'. $valuecomment .'</p>';

        $messagEm .= '</body></html>';



        
    };

};
