<?php
/**
 * @link http://www.diggin-data.de/
 * @copyright Copyright (c) 2019 Diggin' Data
 * @license http://www.diggin-data.de/license/
 */

namespace diggindata\kjua;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files for the [[GridView]] widget.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class QrCodeWidgetAsset extends AssetBundle
{
    public $sourcePath = '@vendor/diggindata/yii2-kjua/src/assets';
    public $css = [
    ];
    public $js = [
        'js/kjua-0.9.0.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
