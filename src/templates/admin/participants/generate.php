<?php

use Certify\Certify\core\certificates\Generate;
use Certify\Certify\core\SendMail;
use Certify\Certify\models\Certificate;
use Certify\Certify\models\Participants;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid arguments");
}

$participants = new Participants;
$participant = $participants->get($id);

if(!empty($_POST)){
    $is_winner = ($_POST['is_winner'] == 1 || $_POST['is_winner'] == 0) ? $_POST['is_winner'] : null;
    if($is_winner == 1){
        $place = ($_POST['place'] == 1 || $_POST['place'] == 2 || $_POST['place'] == 3) ? $_POST['place'] : null;
    }else{
        $place = 0;
    }

    if($is_winner === null || $place === null){
        die("Invalid values");
    }

    $update_result = $participants->update($participant['first_name'], $participant['last_name'], $participant['email'], $participant['usn'], $participant['degree'], $participant['organization'], $participant['competition'], $is_winner, $place);
    if($update_result['result'] == false){
        die("Unable to generate certificate");
    }

    $generate = new Generate();

    if($is_winner == 1){
        if($place == 1){
            $place = "First";
        }else if($place == 2){
            $place = "Second";
        }else{
            $place = "Third";
        }
        $certificate = $generate->generate_winner_certificate($participant['first_name'] . " " . $participant['last_name'], $participant['degree'], $place, $participant['competition'], "2022-23");
    }else{
        $certificate = $generate->generate_participant_certificate($participant['first_name'] . " " . $participant['last_name'], $participant['degree'], $participant['competition'], "2022-23");
    }

    $certificate = $certificate['image'];
    $cer = new Certificate;
    $result = $cer->create($participant['id'], $certificate);
        
    $mail = new SendMail();
    $first_name = $participant['first_name'];
    $download_link = 'http://certify.localhost/download/certificate.php?c='. basename($certificate);
    $body = <<<EOD
    <html>
        <head>
            <title>APSCE admin password reset</title>
        </head>
        <body>
        <div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope="" itemtype="http://schema.org/ConfirmAction" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;">
            <tbody><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; color: #495057; font-size: 14px; vertical-align: top; margin: 0;padding: 30px; box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03); ;border-radius: 7px; background-color: #fff;" valign="top">
                    <meta itemprop="name" content="Confirm Email" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <tbody><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                Hello $first_name
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                            <p>Your request for Certificate is generated successfully.</p>
                                <p><a href="http://certify.localhost$certificate">http://certify.localhost$certificate</a></p>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" itemprop="handler" itemscope="" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                <a href="http://certify.localhost$certificate" itemprop="url" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #34c38f; margin: 0; border-color: #34c38f; border-style: solid; border-width: 8px 16px;">View Certificate</a>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" itemprop="handler" itemscope="" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                <a href="$download_link" itemprop="url" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #34c38f; margin: 0; border-color: #34c38f; border-style: solid; border-width: 8px 16px;">Download Certificate</a>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                <b>APSCE College</b>
                                <p>Administrator</p>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="text-align: center;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top">
                                © 2023 APSCE College
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
    </div>
        </body>
    </html>
    EOD;
    $result = $mail->send($participant['email'], "Your Certificate is here", $body, true);

    if($result['result']){
        header("Location: /admin/participants/");
    }else{
        die("Unable to generate certificate for the participant");
    }
}
?>

<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Generate Certificate</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="col-sm-2 form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="<?= $participant['email'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="is_winner" class="col-sm-2 form-label">Is Winner?</label>
                    <select name="is_winner" id="place" class="form-select" required>
                        <option selected>Select</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>               
                </div>
                <div class="mb-3">
                    <label for="place" class="col-sm-2 form-label">Place Secured</label>
                    <select name="place" id="place" class="form-select" required>
                        <option selected>Select</option>
                        <option value="1">First</option>
                        <option value="2">Second</option>
                        <option value="3">Third</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>