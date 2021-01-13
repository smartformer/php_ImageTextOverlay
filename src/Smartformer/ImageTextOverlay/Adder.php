<?php

namespace Smartformer\ImageTextOverlay;

class Adder {

    /**
     * @var Font Path
     */
    private $fontPath;

    function __construct($fontPath){
        $this->fontPath = $fontPath;
    }

    /**
     * Add text to JPEG
     */
    public function addTextToJpeg($text, $img_path, $output, $padding = 15, $r = 0, $g = 0, $b = 0, $font_size = 70, $angle = 0) {
        $our_image = imagecreatefromjpeg($img_path);
        $color = imagecolorallocate($our_image, $r, $g, $b);
        $image_info = getimagesize($img_path);
        
        /* Create text */
        $text_box = imagettfbbox($font_size, $angle, $this->fontPath, $text);
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[7] - $text_box[1];     
        while(($text_width > ($image_info[0] - $padding))) {
            $font_size--;
            $text_box = imagettfbbox($font_size, $angle, $this->fontPath, $text);
            $text_width = $text_box[2] - $text_box[0];
            $text_height = $text_box[7] - $text_box[1];     
        }
        $top = ($image_info[1] / 2) - ($text_height/2);
        $left = ($image_info[0] / 2) - ($text_width/2);

        imagettftext($our_image, $font_size, $angle, $left, $top, $color, $this->fontPath, $text);
        imagejpeg($our_image, $output);
        imagedestroy($our_image);
    }

    /**
     * Add text to PNG
     */
    public function addTextToPng($text, $img_path, $output, $padding = 15, $r = 0, $g = 0, $b = 0, $font_size = 70, $angle = 0) {
        $our_image = imagecreatefrompng($img_path);
        $color = imagecolorallocate($our_image, $r, $g, $b);
        imageAlphaBlending($our_image, true);
        imageSaveAlpha($our_image, true);
        $image_info = getimagesize($img_path);
        
        /* Create text */
        $text_box = imagettfbbox($font_size, $angle, $this->fontPath, $text);
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[7] - $text_box[1];     
        while(($text_width > ($image_info[0] - $padding))) {
            $font_size--;
            $text_box = imagettfbbox($font_size, $angle, $this->fontPath, $text);
            $text_width = $text_box[2] - $text_box[0];
            $text_height = $text_box[7] - $text_box[1];     
        }
        $top = ($image_info[1] / 2) - ($text_height/2);
        $left = ($image_info[0] / 2) - ($text_width/2);

        imagettftext($our_image, $font_size, $angle, $left, $top, $color, $this->fontPath, $text);
        imagepng($our_image, $output);
        imagedestroy($our_image);
    }

    
}
