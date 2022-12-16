<?php

use Certify\Certify\models\Admin;

$users = new Admin();
$users = $users->getAll();
?>

<div class="col-12">
    <h4 class="mb-2">Admins</h4>
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
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($users as $user){
                            ?>
                            <tr>
                                <th scope="row"><?= $user['id'] ?></th>
                                <td><?= $user['first_name'] ?></td>
                                <td><?= $user['last_name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['created_at'] ?></td>
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