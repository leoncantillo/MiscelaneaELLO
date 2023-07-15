<?php

Class GlobalController {
    # Validate Inputs ---------------------------------
    static public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return($data);
    }

    # Upload Files ------------------------------------
    static public function upload_file($postFile, $destinationFolder) {
        try {
            $directory = __DIR__ . $destinationFolder;
            $file = $directory . $postFile['name'];
            $fileBaseName = pathinfo($file, PATHINFO_FILENAME);
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            $counter = 1;
        
            // Verificar si el archivo ya existe
            while (file_exists($file)) {
                $newFileName = $fileBaseName . '(' . $counter . ').' . $fileExtension;
                $file = $directory . $newFileName;
                $counter++;
            }
        
            move_uploaded_file($postFile['tmp_name'], $file);
            return $newFileName ?? $postFile['name'];
        } catch (Exception $e) {
            return "";
        }
    }
}

?>