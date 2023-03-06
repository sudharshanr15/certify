<?php

use Certify\Certify\models\Participants;
use Certify\Certify\models\Organization;
use Certify\Certify\models\Competition;

$id = $_GET['id'] ?? null;

if(!$id){
    die("Invalid arguments");
}

$participants = new Participants();
$participant_detail = $participants->get($id);

$organization = new Organization();
$organizations_details = $organization->getAll();

$competition = new Competition();
$competition_details = $competition->getAll();

if(strtolower($_SERVER['REQUEST_METHOD']) == "post"){
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $usn = $_POST['usn'] ?? null;
    $degree = $_POST['degree'] ?? null;
    $organization = $_POST['organization'] ?? null;
    $competition = $_POST['competition'] ?? null;

    if($first_name && $last_name && $email && $usn && $degree && $organization && $competition){
        $result = $participants->update($first_name, $last_name, $email, $usn, $degree, $organization, $competition);
        if($result['result'] == true){
            $_SESSION['alert_edit']['message'] = "Participant details changed!";
            header("Location: /admin/participants/edit.php?id=" . $id);
            exit;
        }else{
            echo $result['message'];
            return;
        }
    }else{
        echo "Insufficient field";
        return;
    }
}

?>

<div class="col-xl-8">
    <?php
        if($_SESSION['alert_edit'] != null){
            ?>
            <div class="alert alert-primary">
                <?= $_SESSION['alert_edit']['message'] ?>
            </div>
            <?php
            unset($_SESSION['alert_edit']);
        }
    ?>
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Participant</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="first_name" class="col-sm-2 form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $participant_detail['first_name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="col-sm-2 form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $participant_detail['last_name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="col-sm-2 form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $participant_detail['email'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="usn" class="col-sm-2 form-label">Student USN</label>
                    <input type="text" class="form-control" name="usn" id="usn" value="<?= $participant_detail['usn'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="degree" class="col-sm-2 form-label">Degree</label>
                    <input type="text" class="form-control" name="degree" id="degree" value="<?= $participant_detail['degree'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="organization" class="col-sm-2 form-label">Organization</label>
                    <select class="form-select" name="organization" id="organization">
                        <?php
                            foreach($organizations_details as $org){
                                ?>
                                <option value="<?= $org['name'] ?>" <?= strtolower($org['name']) == strtolower($participant_detail['organization']) ? "selected" : "" ?>><?= $org['name'] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="competiton" class="col-sm-2 form-label">Competition</label>
                    <select class="form-select" name="competition" id="competition">
                        <?php
                            foreach($competition_details as $c){
                                ?>
                                <option value="<?= $c['competition'] ?>" <?= strtolower($c['competition']) == strtolower($participant_detail['competition']) ? "selected" : "" ?>><?= $c['competition'] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>