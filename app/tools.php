<?php

    namespace app;

    class Tools{

        //delete images of buffer folder
        private function clearFolder(){

            $files = glob('./images/buffer/*');

            foreach($files as $file){
                if(is_file($file)) {
                    unlink($file);
                }
            }
        }

        //quartering picture
        private function cropImage(){

            $image = implode("", glob('./images/buffer/*'));

            //set size
            $size = @getimagesize($image);
            $width = $size[0];
            $height = $size[1];

            //margin for crop
            $margin_left = $width/2;
            $margin_top = $height/2;

            //set new area
            $canvas = imagecreatetruecolor($width, $height);

            //set jpeg format
            $current_image = imagecreatefromjpeg($image);

            //make quart part image
            $new_image = './images/buffer/new_image.jpg';

            //make final picture
            imagecopy($canvas, $current_image, 0, 0, $margin_left, $margin_top, $width, $height);
            imagecopy($canvas, $current_image, $margin_left, 0, $margin_left, $margin_top, $width, $height);
            imagecopy($canvas, $current_image, 0, $margin_top, $margin_left, $margin_top, $width, $height);
            imagecopy($canvas, $current_image, $margin_left, $margin_top, $margin_left, $margin_top, $width, $height);
            imagejpeg($canvas, $new_image, 100);

            return $new_image;
        }

        //main function
        public function uploadImage($path_image){
            
            if(isset($_POST['upload'])){

                if($path_image != ''){

                    $this->clearFolder();

                    //download image to buffer folder
                    move_uploaded_file($_FILES['upload_image']['tmp_name'], './images/buffer/'.$path_image);

                    //basic low format filter 
                    switch (substr($path_image, -4)) {
                        case '.png':
                            $response = array(
                                "status" => "Формат .png не поддерживается",
                                "image" => "wall/before.jpg",
                                "new_image" => "./images/wall/after.jpg"
                            );
                            break;
                        case '.jpg':
                            $response = array(
                                "status" => "Файл успешно загружен",
                                "image" => "buffer/".$path_image,
                                "new_image" => $this->cropImage(),
                            );
                            break;
                    }

                }else{
                    $response = array(
                        "status" => "Вы ничего не загрузили",
                        "image" => "wall/before.jpg",
                        "new_image" => "./images/wall/after.jpg"
                    );
                }
            
            }else{
                $response = array(
                    "status" => "Загрузите файл",
                    "image" => "wall/before.jpg",
                    "new_image" => "./images/wall/after.jpg"
                );
            }

            return $response;
        }

    }
?>