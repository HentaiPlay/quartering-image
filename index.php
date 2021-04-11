<?php
    require "./app/tools.php";
    use app\Tools;

    $app = new Tools;
    $response = $app->uploadImage($_FILES['upload_image']['name']);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            img{
                padding: 2px;
                border: 1px solid #000;
                width: 100% !important;
                height: auto; 
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 p-5">

                    <div class="row mb-5">
                        <div class="col-6 p-2">
                            <p>До</p>
                            <? echo '<img src="./images/'.$response['image'].'">'?>
                        </div>
                        <div class="col-6 p-2">
                            <p>После</p>
                            <? echo '<img src="'.$response['new_image'].'">'?>
                        </div>
                    </div>

                    <p><b>Подсказка:</b> <? echo $response['status']; ?></p>

                    <form method="post" enctype="multipart/form-data" class="d-flex">
                        <input type="file" name="upload_image">
                        <input type="submit" name="upload" value="Загрузить и четвертовать" class="btn btn-success ml-auto">
                    </form>

                </div>
            </div>
        </div>

        <pre><? print_r($response['size']) ?></pre>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>