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