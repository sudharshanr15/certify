<?php

use Certify\Certify\core\FileUploads;
use Certify\Certify\models\Signature;

if(strtolower($_SERVER['REQUEST_METHOD']) == "post"){
    $name = $_POST['name'];
    $image = $_FILES['image'];
    $signature = new Signature;    
    
    
    if($name && $image){
        $name = strtolower($name);
        $name_values = ['hod', "principal", "coordinator"];
        if(!in_array($name, $name_values)){
            die("Name is not acceptable");
        }
        $is_exist = false;

        $data = $signature->getByName($name);
        
        $file_uploads = new FileUploads();
        $image_extension = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
        $file_upload = $file_uploads->upload_signature($image, $name . "." . $image_extension);
        
        if($file_upload['result'] === true){
            if($data && count($data) > 0){
                $result = $signature->update($name, $file_upload['image'], $data['id']);
            }else{
                $result = $signature->add($name, $file_upload['image']);
            }

            if($result['result']){
                header("Location: /admin/signatures/");
            }else{
                die($result['message']);
            }
        }else{
            die($file_upload['message']);
        }
    }
}

?>

<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Signature</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="col-sm-2 form-label">Signature Name</label>
                    <select name="name" id="name" class="form-select">
                        <option value="hod">HOD</option>
                        <option value="principal">PRINCIPAL</option>
                        <option value="coordinator">COORDINATOR</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="col-sm-2 form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>