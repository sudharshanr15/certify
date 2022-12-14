<?php

use Certify\Certify\models\Competition;

$competition = new Competition;
$competition = $competition->getAll();

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
                            <th scope="col">Competition</th>
                            <th scope="col">Organization ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Year</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($competition as $c){
                            ?>
                            <tr>
                                <th scope="row"><?= $c['id'] ?></th>
                                <td><?= $c['competition'] ?></td>
                                <td><?= $c['organization'] ?></td>
                                <td><img src="<?= $c['image'] ?>" /></td>
                                <td><?= $c['year'] ?></td>
                                <td><a href="<?= '/admin/events/remove.php?id=' . $c['id'] ?>">Delete</a></td>
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