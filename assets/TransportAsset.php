<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TransportAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'web/themes/transport/css/system.css',
        'web/themes/transport/css/bootstrap.css',
        'web/themes/transport/css/bootstrap-theme.css',
        'web/themes/transport/font-awesome/css/font-awesome.css',
        'web/croppic-master/assets/css/main.css',
        'web/croppic-master/assets/css/croppic.css',
    ];
    public $js = [
        'web/themes/transport/js/bootstrap.js',
        'web/croppic-master/assets/js/jquery.mousewheel.min.js',
        'web/croppic-master/croppic.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
