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

        $participant = new Participants;
        foreach($ids as $id){
            $participant = $participant->get($id);

            $generate = new Generate();
            
            if($participant['winner']){
                if($place == 1){
                    $place = "First";
                }else if($place == 2){
                    $place = "Second";
                }else{
                    $place = "Third";
                }
                $certificate = $generate->generate_winner_certificate($participant['first_name'] . " " . $participant['last_name'], $participant['degree'], $participant['place'], $participant['competition'], "2022-23");
            }else{
                $certificate = $generate->generate_participant_certificate($participant['first_name'] . " " . $participant['last_name'], $participant['degree'], $participant['competition'], "2022-23");
            }

            $certificate = $certificate['image'];
            $cer = new Certificate;
            $result = $cer->create($participant['id'], $certificate);
                
            $mail = new SendMail();
            $body = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Certificate</title>
            </head>
            <body>
                <p style="font-size: 24px; text-weight: bold; margin-block: 1rem;">Hello '. $participant['first_name'] .',</p>
                <p>Your request for Certificate is generated successfully.</p>
                <img src="http://certify.localhost'. $certificate .'" alt="" style="height: 100px">
                <div style="">
                    <div style="display: inline-block; margin-inline: 0.5rem;">
                        <a href="http://certify.localhost'. $certificate .'">View Certificate</a>
                    </div>
                    <div style="display: inline-block; margin-inline: 0.5rem;">
                        <a href="http://certify.localhost/download/certificate.php?c='. basename($certificate) .'">Download Certificate</a>
                    </div>
                </div>
            </body>
            </html>
            ';
            $result = $mail->send($participant['email'], "Your Certificate is here", $body, true);
        }

        header("Location: /admin/participants");
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