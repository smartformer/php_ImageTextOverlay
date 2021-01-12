# ImageTextOverlay

This is a Helper Class, which will put an overlay Text on an image and generate a new image from it.

## Usage

```php
$adder = new Smartformer\ImageTextOverlay\Adder('fonts/Roboto/Roboto-Regular.ttf');
$adder->addTextToJpeg('Your Text', 'input.jpeg', 'output.jpg');
$adder->addTextToPng('Your Text', 'input.png', 'output.png');
```
