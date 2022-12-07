<?php

use Certify\Certify\core\FileUploads;
use Certify\Certify\models\Organization;

$file_uploads = new FileUploads;

$organization = new Organization;

$name = $_POST['name'] ?? null;
$image = $_FILES["image"] ?? null;

if($name && $image['name']){
    $file = $file_uploads->upload_image($image);
    if($file['result'] == false){
        die($result['message']);
    }

    $result = $organization->create($name, $file["image"]);

    if($result['result'] == false){
        die($result['message']);
    }

    header("Location: /admin/organization/");
}

?>

<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Organization</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="col-sm-2 form-label">Organization Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="col-sm-2 form-label">Organization Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>