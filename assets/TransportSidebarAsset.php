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
class TransportSidebarAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/themes/transport-sidebar/css/bootstrap.css',
        'web/themes/transport-sidebar/css/animate.min.css',
        'web/themes/transport-sidebar/css/light-bootstrap-dashboard.css',
        'web/themes/transport-sidebar/css/pe-icon-7-stroke.css',
        'web/themes/transport-sidebar/font-awesome/css/font-awesome.css',
        'web/croppic-master/assets/css/main.css',
        'web/croppic-master/assets/css/croppic.css',
    ];
    public $js = [
        'web/themes/transport-sidebar/js/bootstrap.min.js',
        'web/themes/transport-sidebar/js/bootstrap-notify.js',
        'web/themes/transport-sidebar/js/light-bootstrap-dashboard.js',
        'web/croppic-master/assets/js/jquery.mousewheel.min.js',
        'web/croppic-master/croppic.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
