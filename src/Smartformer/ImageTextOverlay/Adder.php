<?php

namespace Smartformer\ImageTextOverlay;

class Adder {

    /**
     * @var Font Path
     */
    private $fontPath;

    function __construct($font){
        $this->fontPath = $fontPath;
    }

    /**
     * Add text to JPEG
     */
    public function addTextToJpeg($text, $img_path, $output, $r = 0, $g = 0, $b = 0, $font_size = 70, $angle = 0) {
        $our_image = imagecreatefromjpeg($img_path);
        $color = imagecolorallocate($our_image, $r, $g, $b);
        $image_info = getimagesize($img_path);
        $left = $image_info[0] / 2;
        $top = $image_info[1] / 2;
        
        $text_box = imagettfbbox($font_size, $angle, $this->fontPath, $text);
        $text_width = $text_box[2]-$text_box[0];
        $text_height = $text_box[7]-$text_box[1];
        $left = ($image_info[0] / 2) - ($text_width/2);
        $top = ($image_info[1] / 2) - ($text_height/2);

        // Shadow
        $grey = imagecolorallocate($our_image, 128, 128, 128);
        imagettftext($our_image, $font_size, $angle, $left, $top+1, $grey, $this->font, $text);
        
        imagettftext($our_image, $font_size, $angle, $left, $top, $color, $this->font, $text);
        imagejpeg($our_image, $output);
        imagedestroy($our_image);
    }

    /**
     * Add text to PNG
     */
    public function addTextToPng($text, $img_path, $output, $r = 0, $g = 0, $b = 0, $font_size = 70, $angle = 0) {
        $our_image = imagecreatefrompng($img_path);
        $color = imagecolorallocate($our_image, $r, $g, $b);
        $image_info = getimagesize($img_path);
        $left = $image_info[0] / 2;
        $top = $image_info[1] / 2;
        
        $text_box = imagettfbbox($font_size, $angle, $this->fontPath, $text);
        $text_width = $text_box[2]-$text_box[0];
        $text_height = $text_box[7]-$text_box[1];
        $left = ($image_info[0] / 2) - ($text_width/2);
        $top = ($image_info[1] / 2) - ($text_height/2);

        // Shadow
        $grey = imagecolorallocate($our_image, 128, 128, 128);
        imagettftext($our_image, $font_size, $angle, $left, $top+1, $grey, $this->font, $text);
        
        imagettftext($our_image, $font_size, $angle, $left, $top, $color, $this->font, $text);
        imagepng($our_image, $output);
        imagedestroy($our_image);
    }
}
