<?php
header('Content-Type: image/jpeg'); // Кодирока
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if ($_FILES['picture']){
        
            $path = 'images/';
            $tmp_path = 'tmp/';     
            $types = array('image/gif', 'image/png', 'image/jpeg');          
            $size = 6024000;
            $timedate = time().rand(100,999); 

            function resize($file, $rotate = null, $quality = null)       // function works using integrated into php GD library 
            {
                global $tmp_path;

                // Ограничение по ширине в пикселях
                $max_width_size = 200;
                $max_height_size = 100;     

                // Качество изображения по умолчанию
                if ($quality == null)
                    $quality = 100;

                // Cоздаём исходное изображение на основе исходного файла
                if ($file['type'] == 'image/jpeg')
                    $source = imagecreatefromjpeg($file['tmp_name']);
                elseif ($file['type'] == 'image/png')
                    $source = imagecreatefrompng($file['tmp_name']);
                elseif ($file['type'] == 'image/gif')
                    $source = imagecreatefromgif($file['tmp_name']);
                else
                    return false;

                // Поворачиваем изображение, если необходимо
                if ($rotate != null)
                    $src = imagerotate($source, $rotate, 0);
                else
                    $src = $source;

                // Определяем ширину и высоту изображения
                $width_src = imagesx($src);
                $height_src = imagesy($src); 
                
                // Если ширина больше заданной
                if ($height_src > $max_height_size)
                {
                    // Вычисление пропорций
                    $ratio = $height_src/$max_height_size;
                    $w_dest = @round($width_src/$ratio);
                    $h_dest = @round($height_src/$ratio);

                    // Создаём пустую картинку
                    $dest = @imagecreatetruecolor($max_width_size, $max_height_size);

                    // Копируем старое изображение в новое с изменением параметров
                    @imagecopyresampled($dest, $src, 0, 0, 0, 0, $max_width_size, $max_height_size , $width_src, $height_src);

                    // Вывод картинки и очистка памяти
                    @imagejpeg($dest, $tmp_path . $file['name'], $quality);
                    
                    @imagejpeg($dest);

                    @imagedestroy($dest);
                    @imagedestroy($src);

                    return $file['name'];

                } else {
                    // Вывод картинки и очистка памяти
                    @imagejpeg($src, $tmp_path . $file['name'], $quality);
                    @imagedestroy($src);
                    
                    return $file['name'];
                }
            }

            $name = resize($_FILES['picture'], $_POST['file_type'], $_POST['file_rotate']);
            
            // Загрузка файла и вывод сообщения
            if (!@copy($tmp_path . $name, $path . $name)){
                echo '';
            } else {                        
                echo '<script> window.top.work("' . $path . $_FILES['picture']['name'] . '"); </script>';
            }

            unlink($tmp_path . $name);
    }
}
?>

