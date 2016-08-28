<?php

    session_start();
    
    $heigh=130;
    $width=34;
    
    // Crear una imagen de 100*30
    $im = imagecreate($heigh, $width);
    
    // colores
    $fondo = imagecolorallocate($im, 220, 220, 220);
    $color_texto = imagecolorallocate($im, 100, 0, 0);
    $line_color = imagecolorallocate($im, 100,100,64); 
    $pixel_color = imagecolorallocate($im, 0,0,255);
    $font = 'fonts/Arial Bold Italic.ttf';
    
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $result = '';
    for ($i = 0; $i < 5; $i++){
        $result .= $characters[mt_rand(0, 61)];
    }
    
    $_SESSION['captcha']= $result;
    
    
    //imagestring($im, 5, 20, 10, $result, $color_texto);
    
    $text = 'Testing...';
    // Replace path by your own font path
   
    
    // Add some shadow to the text
    imagettftext($im, 20, 0, 18,29, $color_texto, $font, $result);
    
    
    for($i=0;$i<7;$i++) {
        imageline($im,0,rand()%50,200,rand()%50,$line_color);
    }
    
    
    wave_area($im,1,0,$heigh,$width,8,26);
    
    
    
    for($i=0;$i<1000;$i++) {
        imagesetpixel($im,rand()%200,rand()%50,$pixel_color);
    }
    
    
    // Imprimir la imagen
    header('Content-type: image/png');
    
    imagepng($im);
    imagedestroy($im);
    
    function wave_area($img, $x, $y, $width, $height, $amplitude = 10, $period = 10){ 
        // Make a copy of the image twice the size 
        $height2 = $height * 2; 
        $width2 = $width * 2; 
        $img2 = imagecreatetruecolor($width2, $height2); 
        imagecopyresampled($img2, $img, 0, 0, $x, $y, $width2, $height2, $width, $height); 
        if($period == 0) $period = 1; 
        // Wave it 
        for($i = 0; $i < ($width2); $i += 2) 
            imagecopy($img2, $img2, $x + $i - 2, $y + sin($i / $period) * $amplitude, $x + $i, $y, 2, $height2); 
        // Resample it down again 
        imagecopyresampled($img, $img2, $x, $y, 0, 0, $width, $height, $width2, $height2); 
        imagedestroy($img2); 
    } 



?>