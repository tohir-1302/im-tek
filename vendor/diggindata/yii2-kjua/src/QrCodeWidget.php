<?php
/**
 * @link http://www.diggin-data.de/
 * @copyright Copyright (c) 2019 Diggin' Data
 * @license http://www.diggin-data.de/license/
 */

namespace diggindata\kjua;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\json;
use yii\web\View;

class QrCodeWidget extends Widget
{
    private $_id;

    // render method: 'canvas', 'image' or 'svg'
    public $render = 'image';

    // render pixel-perfect lines
    public $crisp = true; 

    // minimum version: 1..40
    public $minVersion = 1;

    // error correction level: 'L', 'M', 'Q' or 'H'
    public $ecLevel = 'L';

    // size in pixel
    public $size = 200;

    // pixel-ratio, null for devicePixelRatio
    public $ratio = null;

    // code color
    public $fill = '#333';

    // background color
    public $back = '#fff';

    // content
    public $text = 'no text';

    // roundend corners in pc: 0..100
    public $rounded = 0;

    // quiet zone in modules (0-4)
    public $quiet = 0;

    // modes: 'plain', 'label' or 'image'
    public $mode = 'plain';

    // label/image size and pos in pc: 0..100
    public $mSize = 30;
    public $mPosX = 50;
    public $mPosY = 50;

    // label
    public $label = 'no label';
    public $fontname = 'Arial';
    public $fontcolor = '#333';

    // image element
    public $image = null;

    public $options = array();

    public  $attributes = 'text;render;crisp;minVersion;ecLevel;size;ratio;fill;back;text;rounded;quiet;mode;mSize;mPosX;mPosY;label;fontname;fontcolor;image';

    public function init()
    {
        $this->_id='qrcode-'.uniqid();
        parent::init();
        if ($this->text === null) {
            $this->text = 'Hello World';
        }
    }

    public function run()
    {
        /* DEBUG
        \yii\helpers\VarDumper::dump(array(
            'render' => $this->render,
            'text' => $this->text,
            'size' => $this->size,
        ), 10, true);
         */
        $view = $this->getView();
        QrCodeWidgetAsset::register($view);
        $optionsString = '';
        if(is_array($this->options) and count($this->options)>0) {
            $optionsPairs = [];
            foreach($this->options as $k=>$v) {
                $optionsPairs[] = $k . '="'.$v.'"';
            }
            $optionsString = ' '.join(' ', $optionsPairs);
        }
        echo '<div id="'.$this->_id.'"'.$optionsString.'></div>';

        $cfg = new \StdClass;
        foreach(explode(';', $this->attributes) as $attribute) {
            switch($attribute)
            {
            case 'render':
                if(!in_array($this->$attribute, array('canvas', 'image', 'svg')))
                    throw new \Exception('Atttribute render must be either canvas, image or svg');

                break;
            case 'crisp':
                if($this->$attribute!==true and $this->$attribute!==false)
                    throw new \Exception('Atttribute crisp must be either true or false');
                break;
            case 'minVersion':
                if(!in_array($this->$attribute, range(1, 40)))
                    throw new \Exception('Atttribute '.$attribute.' must be in range 1 to 40');
                break;
            case 'ecLevel':
                if(!in_array($this->$attribute, array('L', 'M', 'Q', 'H')))
                    throw new \Exception('Atttribute ecLevel must be L, M, Q or H');

                break;
            case 'mode':
                if(!in_array($this->$attribute, array('plain', 'label', 'image')))
                    throw new \Exception('Atttribute mode must be plain, label or image');
                break;
            case 'fill':
            case 'back';
            case 'fontcolor':
                if(!preg_match('/#([a-f0-9]{3}){1,2}\b/i', $this->$attribute, $matches)
                    and !preg_match('/(White|Silver|Gray|Black|Red|Maroon|Yellow|Olive|Lime|Green|Aqua|Teal|Blue|Navy|Fuchsia|Purple)/i', $this->$attribute, $matches2)
                    )
                    throw new \Exception('Atttribute '.$attribute.' must be like #ABC or like #AABBCC or use HTML color names');
                break;
            case 'mode':
                if(!in_array($this->$attribute, range(0, 4)))
                    throw new \Exception('Atttribute '.$attribute.' must be in range 0 to 4');
                break;
            case 'rounded':
            case 'mSize':
            case 'mPosX':
            case 'mPosY':
                if(!preg_match('/^[1-9][0-9]?$|^100$|^0$/', $this->$attribute, $matches))
                    throw new \Exception('Atttribute '.$attribute.' must be between 0 and 100');
                break;
            case 'quiet':
                if(!in_array($this->$attribute, range(0, 4)))
                    throw new \Exception('Atttribute '.$attribute.' must be in range 0 to 4');
                break;
            }
            $cfg->$attribute = $this->$attribute;
        }
        $view->registerJs("
// Handle QRCode for div ".$this->_id."<F5>
var cfg = ".Json::encode($cfg).";
$('#".$this->_id."').kjua(cfg);",
            View::POS_READY,
            'qrcode-handler-'.$this->_id
        );
    }
}
