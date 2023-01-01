<?php

use Certify\Certify\core\certificates\Generate;
use Certify\Certify\core\FileUploads;
use Certify\Certify\core\ImportFile;
use Certify\Certify\core\SendMail;
use Certify\Certify\models\Certificate;
use Certify\Certify\models\Participants;

$file = $_FILES['import_file'] ?? null;

if($file['name']){
    $file_uploads = new FileUploads;
    $result = $file_uploads->upload_participants_csv($file);
    if($result['result']){
        $import = new ImportFile;
        $ids = $import->import_participants_csv();

        $_SESSION['alert_import'] = ['result' => true, "message" => "Users imported successfully"];
        header("Location: /admin/participants/");
    }else{
        die("Unable to upload file");
    }
}

?>

<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Import Participants</h4>
            <form method="post" action="/admin/participants/import.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="col-sm-2 form-label">Import file</label>
                    <input type="file" class="form-control" name="import_file" id="import_file">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>