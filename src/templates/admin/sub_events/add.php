<?php

use Certify\Certify\core\FileUploads;
use Certify\Certify\models\Subevents;
use Certify\Certify\models\Competition;

$file_uploads = new FileUploads;
$competiton_obj = new Competition;
$sub_events_obj = new Subevents;

if(strtolower($_SERVER['REQUEST_METHOD']) == "post"){
    $name = $_POST['name'] ?? null;
    $image = $_FILES['image'] ?? null;
    $competition = $_POST['competition'] ?? null;

    if($name && $image['name'] && $competition){
        $file = $file_uploads->upload_image($image);
        if($file['result'] == false){
            die($result['message']);
        }
    
        $result = $sub_events_obj->create($name, $competition, $file['image']);
    
        if($result['result'] == false){
            die($result['message']);
        }
    
        header("Location: /admin/sub_events/");
    }else{
        die("Invalid fields!");
    }
    return;
}

$competitions = $competiton_obj->getAll();
?>

<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Sub event</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="col-sm-2 form-label">Sub event Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="competition" class="col-sm-2 form-label">Competition</label>
                    <select name="competition" id="competition" class="form-select" required>
                        <option selected disabled>Select Competition</option>
                        <?php
                        foreach($competitions as $competition){
                            ?>
                            <option value="<?= $competition['id'] ?>"><?= $competition['competition'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="col-sm-2 form-label">Sub event Logo</label>
                    <input type="file" class="form-control" name="image" id="image" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>