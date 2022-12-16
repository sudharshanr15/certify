<?php

use Certify\Certify\models\Organization;

$organizations = new Organization;
$organizations = $organizations->getAll();

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