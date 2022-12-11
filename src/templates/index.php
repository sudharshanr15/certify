<?php

use Certify\Certify\core\certificates\Generate;
use Certify\Certify\models\Competition;
use Certify\Certify\models\Organization;
use Certify\Certify\models\Participants;
use Certify\Certify\core\SendMail;
use Certify\Certify\models\Certificate;

$organizations = new Organization;
$events = new Competition;
$participants = new Participants;

if(!empty($_POST)){
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $degree = $_POST['degree'] ?? null;
    $organization = $_POST['organization'] ?? null;
    $event = $_POST['event'] ?? null;
    $winner = $_POST['winner'] ?? null;
    $place = $_POST['place'] ?? null;

    if($first_name && $last_name && $email && $degree && $organization && $event && $winner){
        if($winner == "yes"){
            if(!$place){
                $_SESSION['res_message'] = [
                    "result" => false,
                    "message" => "Please Fill Place Secured field"
                ];
            }
        }

        $result = $participants->create($first_name, $last_name, $email, $degree, $organization, $event, $winner == "yes" ? 1 : 0, $winner == "yes" ? $place : 0);
        if($result['result']){
            $generate = new Generate();
            $event_name = $events->get($event)['competition'];
            if($winner == "yes"){
                if($place == 1){
                    $place = "First";
                }else if($place == 2){
                    $place = "Second";
                }else{
                    $place = "Third";
                }
                $certificate = $generate->generate_winner_certificate($first_name . " " . $last_name, $degree, $place, $event_name, "2022-23");
            }else{
                $certificate = $generate->generate_participant_certificate($first_name . " " . $last_name, $degree, $event_name, "2022-23");
            }

            $certificate = $certificate['image'];
            $cer = new Certificate;
            $user_id = $participants->getFromUserEmail($email);
            $result = $cer->create($user_id, $certificate);
            if($result['result'] == true){

                $mail = new SendMail();
                $body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <title>Certificate</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
                </head>
                <body>
                    <p class="mb-3">Hello,</p>
                    <p class="mb-3">Your request for certificate is generated successfully!.</p>
                    <img class="mb-3" src="http://certify.localhost'. $certificate .'" alt="" style="height: 100px">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <a href="http://certify.localhost'. $certificate .'" class="btn btn-primary">View Certificate</a>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a href="http://certify.localhost/download/certificate.php?c='. basename($certificate) .'" class="btn btn-primary">Download Certificate</a>
                        </div>
                    </div>
                </body>
                </html>
                ';
                $result = $mail->send($email, "Your Certificate is here", $body, true);
    
                if($result['result'] == true){
                    $_SESSION['res_message'] = [
                        "result" => true,
                        "message" => "Participant Registered successfully"
                    ];
                }else{
                    $_SESSION['res_message'] = [
                        "result" => false,
                        "message" => "Unable to register user. Please try again!"
                    ];
                }
            }else{
                $_SESSION['res_message'] = [
                    "result" => true,
                    "message" => "Participant Registered successfully"
                ];
            }
        }else{
            $_SESSION['res_message'] = [
                "result" => false,
                "message" => "Unable to register user. Please try again!"
            ];
        }
    }else{
        $_SESSION['res_message'] = [
            "result" => false,
            "message" => "Fill all the required fields in the form"
        ];
    }

    unset($_POST);
}

$organizations = $organizations->getAll();
$events = $events->getAll();
$participants = $participants->getAll();

?>
<div class="main container">
    <?php
        $result = $_SESSION['res_message'];
        if($result){
            ?>
            <div class="<?= "alert alert-dismissible fade show mt-2 " . ($result['result'] == true ? 'alert-primary' : "alert-danger") ?>">
                <?= $result['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['res_message']);
        }
    ?>
    <section class="section pt-5" id="home">
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <h1>Fill your details to get your <b>Certificate Instantly</b></h1>
                    <div class="hero-image w-100">
                        <img src="/assets/images/hero_image.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-7">
                <form action="" method="POST">
                    <div class="card border border-0 shadow participation-form">
                        <div class="card-body">
                            <h4 class="card-title mb-4 fw-bold">Enter your details to Generate Certificate</h4>
                            <div class="row mb-3">
                                <div class="col-xs-12 col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name" required>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Student Email</label>
                                <input type="email" id="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="degree" class="form-label">Degree</label>
                                <input type="text" id="degree" class="form-control" name="degree" required>
                            </div>
                            <div class="mb-3">
                                <label for="organization" class="form-label">Organization</label>
                                <select class="form-select" id="organization" name="organization" required>
                                    <option selected disabled></option>
                                    <?php
                                    foreach($organizations as $o){
                                        ?>
                                        <option value="<?= $o['id'] ?>"><?= $o['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="event" class="form-label">Event</label>
                                <select class="form-select" id="event" name="event" required>
                                    <option selected disabled></option>
                                    <?php
                                    foreach($events as $e){
                                        ?>
                                        <option value="<?= $e['id'] ?>">
                                            <?= $e['competition'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 form-input-winner">
                                <div for="" class="form-label">Winner of the Event?</div>
                                <input type="radio" id="yes" class="form-check-input" name="winner" value="yes" required>
                                <label for="yes" class="form-label">Yes</label>
                                <input type="radio" id="no" class="form-check-input" name="winner" value="no" required>
                                <label for="no" class="form-label">No</label>
                            </div>
                            <div class="mb-3 form-input-place">
                                <label for="place" class="form-label">Place Secured</label>
                                <select class="form-select" id="place" name="place" required>
                                    <option selected disabled></option>
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="section" id="organizations">
        <div class="pt-5">
            <h2 class="mb-3">Organizations</h2>
            <div class="card border border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="organizations-table" class="display data-table responsive nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Organization Name</th>
                                    <th scope="col">Organization Logo</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($organizations as $o){
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $o['id'] ?></th>
                                        <td><?= $o['name'] ?></td>
                                        <td><img src="<?= $o['logo'] ?>" /></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="events">
        <div class="pt-5">
            <h2>Events conducted by Organizations</h2>
            <div class="card border border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="events-table" class="display data-table responsive nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Competition</th>
                                    <th scope="col">Organization ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Year</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($events as $e){
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $e['id'] ?></th>
                                        <td><?= $e['competition'] ?></td>
                                        <td><?= $e['organization'] ?></td>
                                        <td><img src="<?= $e['image'] ?>" /></td>
                                        <td><?= $e['year'] ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="participants">
        <div class="pt-5">
            <h2>Participants</h2>
            <div class="card border border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="participants-table" class="display data-table responsive nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Degree</th>
                                    <th scope="col">Organization ID</th>
                                    <th scope="col">Event ID</th>
                                    <th scope="col">Is Winner?</th>
                                    <th scope="col">Place Secured</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($participants as $p){
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $p['id'] ?></th>
                                        <td><?= $p['first_name'] ?></td>
                                        <td><?= $p['last_name'] ?></td>
                                        <td><?= $p['email'] ?></td>
                                        <td><?= $p['degree'] ?></td>
                                        <td><?= $p['organization'] ?></td>
                                        <td><?= $p['competition'] ?></td>
                                        <td><?= $p['winner'] ? "True" : "False" ?></td>
                                        <td><?= $p['place'] == 0 ? "False" : $p['place'] ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>