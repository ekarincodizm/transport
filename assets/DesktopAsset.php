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
class DesktopAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/themes/Desktop/css/system.css',
        'web/themes/Desktop/bootstrap/css/bootstrap.css',
        'web/themes/transport/font-awesome/css/font-awesome.css',
        'web/themes/transport/font-awesome/css/font-awesome-animation.css',
        'web/themes/Desktop/dist/css/AdminLTE.min.css',
        'web/themes/Desktop/dist/css/skins/_all-skins.css',
        'web/themes/Desktop/plugins/daterangepicker/daterangepicker-bs3.css',
        'web/themes/Desktop/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'web/themes/Desktop/plugins/datatables/dataTables.bootstrap.css',
        'web/croppic-master/assets/css/main.css',
        'web/croppic-master/assets/css/croppic.css',
        
        //Alert 
        'web/lib/sweetalert-master/dist/sweetalert.css',
         //Model Effect
        'web/lib/custombox-master/src/css/custombox.css',
    ];
    public $js = [
        
        'web/themes/Desktop/bootstrap/js/bootstrap.min.js',
        'web/themes/Desktop/plugins/fastclick/fastclick.min.js',
        'web/themes/Desktop/dist/js/app.min.js',
        'web/themes/Desktop/plugins/sparkline/jquery.sparkline.min.js',
        'web/themes/Desktop/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'web/themes/Desktop/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'web/themes/Desktop/plugins/daterangepicker/daterangepicker.js',
        'web/themes/Desktop/plugins/datepicker/bootstrap-datepicker.js',
        'web/themes/Desktop/plugins/iCheck/icheck.min.js',
        'web/themes/Desktop/plugins/slimScroll/jquery.slimscroll.min.js',
        'web/themes/Desktop/plugins/chartjs/Chart.min.js',
        'web/croppic-master/assets/js/jquery.mousewheel.min.js',
        'web/croppic-master/croppic.min.js',
        'web/themes/Desktop/plugins/datatables/jquery.dataTables.js',
        'web/themes/Desktop/plugins/datatables/dataTables.bootstrap.js',
        //Alert
        'web/lib/sweetalert-master/dist/sweetalert.min.js',
        
        //Model Effect
        'web/lib/custombox-master/dist/custombox.min.js',
        //'web/lib/custombox-master/dist/legacy.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
