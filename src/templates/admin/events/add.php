<?php

use Certify\Certify\core\FileUploads;
use Certify\Certify\models\Competition;
use Certify\Certify\models\Organization;

$competiton = new Competition;
$organizations = new Organization;
$file_uploads = new FileUploads;

$organizations = $organizations->getAll();

$name = $_POST['name'] ?? null;
$organization = $_POST['organization'] ?? null;
$image = $_FILES['image'] ?? null;
$year = $_POST['year'] ?? null;

if($name && $organization && $year){
    if($image['name']){
        $file = $file_uploads->upload_image($image);
    }

    $result = $competiton->create($organization, $name, $file['image'] ?? "", $year);
    if($result['result'] == false){
        die($result['message']);
    }

    header("Location: /admin/events/");
}

?>
<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Event</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="col-sm-2 form-label">Event Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="organization" class="form-label">Organization</label>
                    <select name="organization" id="organization" class="form-select" required>
                        <option selected>Select a Organization</option>
                        <?php
                        foreach($organizations as $c){
                            ?>
                             <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="col-sm-2 form-label">Event Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="year" class="col-sm-2 form-label">Year of Conduct</label>
                    <input type="text" class="form-control" name="year" id="year" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>