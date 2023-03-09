<?php

use Certify\Certify\models\Certificate;
use Certify\Certify\models\Participants;

$participants = new Participants;
$participants = $participants->getAll();

$certificate = new Certificate();
?>

<div class="col-12">
    <?php
        if($_SESSION['alert_import'] != null){
            ?>
            <div class="alert alert-primary">
                <?= $_SESSION['alert_import']['message'] ?>
            </div>
            <?php
            unset($_SESSION['alert_import']);
        }
    ?>
    <h4 class="mb-2">Organization</h4>
    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="display data-table responsive nowrap">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">USN</th>
                            <th scope="col">Degree</th>
                            <th scope="col">Organization</th>
                            <th scope="col">Event</th>
                            <th scope="col">Competition</th>
                            <th scope="col">Is Winner?</th>
                            <th scope="col">Place Secured</th>
                            <th scope="col">Actions</th>
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
                                <td><?= $p['usn'] ?></td>
                                <td><?= $p['degree'] ?></td>
                                <td><?= $p['organization'] ?></td>
                                <td><?= $p['competition'] ?></td>
                                <td><?= $p['sub_event'] ?></td>
                                <td><?= $p['winner'] ? "True" : "False" ?></td>
                                <td><?= $p['place'] == 0 ? "False" : $p['place'] ?></td>
                                <td>
                                <?php
                                    $already_generated = $certificate->getFromUserID($p['id']);
                                    if(count($already_generated) <= 0){
                                        ?>
                                        <a href="<?= '/admin/participants/remove.php?id=' . $p['id']  ?>" class="btn btn-danger me-2">Delete</a>
                                        <a href="<?= '/admin/participants/generate.php?id=' . $p['id']  ?>" class="btn btn-success">Generate</a>
                                        <a href="<?= '/admin/participants/edit.php?id=' . $p['id']  ?>" class="btn btn-success">Edit</a>
                                        <?php
                                    }
                                ?>
                                </td>
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