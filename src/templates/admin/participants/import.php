<?php

$file = $_FILES['import_file'] ?? null;

if($file['name']){
    if(move_uploaded_file($file['tmp_name'], __DIR__ . "/../../../../exports/participants.csv")){
        header("Location: /admin/participants");
    }else{
        die("Unable to upload file");
    }
}

// $file = fopen("exports/participants.csv", "r");
// $i = 0;
// $keys = [];
// while(!feof($file)){
//     $res = fgetcsv($file);
//     if($i == 0){
//         $i++;
//         foreach($res as $k){
//             $keys[] = $k;
//         }
//         continue;
//     }
//     print_r(array_combine($keys, $res));
// }
// fclose($file);

?>

<div class="col-xl-8">
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">Import Participants</h4>
            <form method="post" action="/admin/participants/import.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="col-sm-2 form-label">Import file</label>
                    <input type="file" class="form-control" name="import_file" id="import_file">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>