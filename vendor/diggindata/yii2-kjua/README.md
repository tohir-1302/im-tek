QRCode (kjua) Extension for Yii 2
=================================

This extension provides a **kjua** QR Code widget for [Yii framework 2.0](http://www.yiiframework.com).

The **kjua** library is provided by [github/lrsjng](https://github.com/lrsjng).

[Latest Stable Version](https://packagist.org/packages/diggindata/yii2-kjua)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist diggindata/yii2-kjua
```

or add

```json
"diggindata/yii2-kjua": "@dev"
```

to the require section of your composer.json, then run `composer update`.


Usage
-----

1. Include the QRCode widget in a view file:

```php
<?php
use diggindata\kjua\QrCodeWidget;
```

2. Set some attributes:

```php
<?php
$attributes = [
    'label' => 'My Label',
    'mode' => 'label',
    'fill' => 'navy',
    'text' => 'Good morning',
    'rounded' => 50,
    'ecLevel' => 'M',
    'crisp' => false,
    'mSize' => 20,
    'options'=>['style'=>'display:inline']
]; 
```

3. Show the QRCode:

```php
<?= QrCodeWidget::widget($attributes); ?>
```

The list of available attributes is described here: [https://larsjung.de/kjua/](https://larsjung.de/kjua/).

On that page there is also a link to a demo page available.


Attributes List
---------------

```
// render method: 'canvas', 'image' or 'svg'
render: 'image',

// render pixel-perfect lines
crisp: true,

// minimum version: 1..40
minVersion: 1,

// error correction level: 'L', 'M', 'Q' or 'H'
ecLevel: 'L',

// size in pixel
size: 200,

// pixel-ratio, null for devicePixelRatio
ratio: null,

// code color
fill: '#333',

// background color
back: '#fff',

// content
text: 'no text',

// roundend corners in pc: 0..100
rounded: 0,

// quiet zone in modules
quiet: 0,

// modes: 'plain', 'label' or 'image'
mode: 'plain',

// label/image size and pos in pc: 0..100
mSize: 30,
mPosX: 50,
mPosY: 50,

// label
label: 'no label',
fontname: 'sans',
fontcolor: '#333',

// image element
image: null
```

