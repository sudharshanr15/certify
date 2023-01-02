<?php

use Certify\Certify\models\Certificate;
use Certify\Certify\models\Participants;

$participant = new Participants;

$certificate = new Certificate;
$certificate = $certificate->getAll();

?>

<div class="col-12">
    <h4 class="mb-2">Certificates</h4>
    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="display data-table responsive nowrap">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">User ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($certificate as $c){
                            $user = $participant->get($c['user_id']);
                            ?>
                            <tr>
                                <th scope="row"><?= $c['id'] ?></th>
                                <td><?= $c['user_id'] ?></td>
                                <td><?= $user['first_name'] ?></td>
                                <td><?= $user['last_name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><img src="<?= $c['certificate'] ?>" /></td>
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