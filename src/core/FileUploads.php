<?php

namespace Certify\Certify\core;

class FileUploads{
    public $to_assets_dir = __DIR__ . "/../..";
    public $target_dir = __DIR__ . "/../../assets/uploads/";

    public function upload_image_multiple($files){
        $uploadOK = 1;
        $target_file = "";

        $resulting_msg = "";

        for($i=0; $i<count($files['name']); $i++){
            $file_name = md5(round(microtime(true))) . basename($files['name'][$i]);
            $target_file = $this->target_dir . $file_name;
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            $check_image = getimagesize($files['tmp_name'][$i]);
            
            if(!$check_image){
                $resulting_msg .= "File is not an image.";
                $uploadOK = 0;
            }

            if(file_exists($target_file)){
                $resulting_msg .= "File already exists.";
                $uploadOK = 0;
            }

            if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif"){
                $resulting_msg .= "File format not allowed";
                $uploadOK = 0;
            }

            if($uploadOK == 0){
                break;
            }
        }

        if($uploadOK == 0){
            return ["result" => false, "message" => $resulting_msg];
        }

        $uploadOK = 1;
        $resulting_msg = "";
        $images = [];

        // upload file after condition checks
        for($i=0; $i<count($files['name']); $i++){
            $file_name = md5(round(microtime(true))) . basename($files['name'][$i]);
            $target_file = $this->target_dir . $file_name;
            if(move_uploaded_file($files['tmp_name'][$i], $target_file)){
                $images[] = strstr($this->target_dir, "/assets") . $file_name;
            }else{
                $uploadOK = 0;

            }
        }

        if($uploadOK == 0){
            return ["result" => false, "message" => "Unable to upload file, Please try again"];
        }

        return ["result" => true, "images" => $images];
    }

    public function upload_image($file){
        $uploadOK = 1;
        $file_name = md5(round(microtime(true))) . basename($file["name"]);
        $target_file = $this->target_dir . $file_name;

        $resulting_msg = "";
        $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check_image = getimagesize($file['tmp_name']);

        if(!$check_image){
            $resulting_msg .= "File is not an image.";
            $uploadOK = 0;
        }

        if(file_exists($target_file)){
            $resulting_msg .= "File already exists.";
            $uploadOK = 0;
        }

        if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif"){
            $resulting_msg .= "File format not allowed";
            $uploadOK = 0;
        }

        if($uploadOK == 0){
            return ["result" => false, "message" => $resulting_msg];
        }

        $uploadOK = 1;
        $resulting_msg = "";
        $image = "";
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $image = strstr($this->target_dir, "/assets") . $file_name;
        } else {
            $uploadOK = 0;
        }

        if($uploadOK == 0){
            return ["result" => false, "message" => "Unable to upload file, Please try again"];
        }

        return ["result" => true, "image" => $image];
    }

    public function remove_image($file_path){
        unlink($this->to_assets_dir . $file_path);
    }
}