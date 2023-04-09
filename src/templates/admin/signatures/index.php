<?php

use Certify\Certify\models\Signature;

$signature = new Signature;

$signature = $signature->getAll();

?>

<div class="col-12">
    <h4 class="mb-2">Signatures</h4>
    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="display data-table responsive nowrap">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($signature as $s){
                            ?>
                            <tr>
                                <th scope="row"><?= $s['id'] ?></th>
                                <td><?= $s['name'] ?></td>
                                <td><img src="<?= $s['image'] ?>" alt=""></td>
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