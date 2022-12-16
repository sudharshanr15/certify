<?php

use Certify\Certify\models\Certificate;

$certificate = new Certificate;
$certificate = $certificate->getAll();

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
                            <th scope="col">User ID</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($certificate as $c){
                            ?>
                            <tr>
                                <th scope="row"><?= $c['id'] ?></th>
                                <td><?= $c['user_id'] ?></td>
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