<?php

use Certify\Certify\models\Subevents;

$sub_events_obj = new Subevents;
$sub_events = $sub_events_obj->getAll();

?>

<div class="col-12">
    <h4 class="mb-2">Organization</h4>
    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="display data-table responsive nowrap">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Sub event Name</th>
                            <th scope="col">Competition ID</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($sub_events as $sub_event){
                            ?>
                            <tr>
                                <th scope="row"><?= $sub_event['id'] ?></th>
                                <td><?= $sub_event['name'] ?></td>
                                <td><?= $sub_event['competition'] ?></td>
                                <td><img src="<?= $sub_event['logo'] ?>" /></td>
                                <td><a href="<?= "/admin/sub_events/remove.php?id=" . $sub_event['id'] ?>">Delete</a></td>
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