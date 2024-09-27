<?php
try {
    // Check if a file was uploaded
    if($_POST['action']=='updateTemplate'){

        
    }
    if($_FILES['templateFiles']==null){
    	throw new Exception('no file was provided');
    }
    if ($_FILES['templateFiles']['error'] == UPLOAD_ERR_OK) {
        
        // File details
        $fileName = $_FILES['templateFiles']['name'];
        $fileType = $_FILES['templateFiles']['type'];
        $fileSize = $_FILES['templateFiles']['size'];
        $tmpName = $_FILES['templateFiles']['tmp_name'];

        // Validate file size
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($fileSize > $maxSize) {
            throw new Exception('File exceeds maximum size of 5MB.');
        }

        // Move uploaded file to desired location
        $uploadDir = './uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $newFilePath = $uploadDir . $fileName;

        // Prevent overwriting existing files
        if (file_exists($newFilePath)) {
            throw new Exception('File already exists. Please choose a different name.');
        }

        // Move uploaded file
        if (!move_uploaded_file($tmpName, $newFilePath)) {
            throw new Exception('Failed to move uploaded file.');
        }

        echo "File uploaded successfully!";
    } else {
        // Handle upload errors
        switch ($_FILES['templateFiles']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('File exceeds maximum size allowed by PHP.');
                break;
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception('File exceeds maximum size specified in HTML form.');
                break;
            case UPLOAD_ERR_PARTIAL:
                throw new Exception('File was only partially uploaded.');
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file was uploaded.');
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                throw new Exception('Missing temporary folder.');
                break;
            case UPLOAD_ERR_CANT_WRITE:
                throw new Exception('Failed to write file to disk.');
                break;
            case UPLOAD_ERR_EXTENSION:
                throw new Exception('A PHP extension stopped the file upload.');
                break;
        }
    }
    $data['status']='success';
    setcookie('uploadTemplate',json_encode($data),time()+(300*10),'/')
} catch (Exception $e) {
    $data['status']='failed';
    $data['error']=$e->getMessage();
    setcookie('uploadTemplate',json_encode($data),time()+(300*10),'/')

}
