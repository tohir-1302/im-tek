<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/bootstrap1.min.css",
        "css/metisMenu.css",
        "css/style1.css", 
        "css/colors/default.css",
    ];
    public $js = [
        'js/mathlive.js',
        "js/jquery1-3.4.1.min.js",
        "js/popper1.min.js",
        "js/bootstrap1.min.js",
        "js/metisMenu.js",
        "js/chart.min.js",
        "js/dashboard_init.js",
        "js/custom.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
