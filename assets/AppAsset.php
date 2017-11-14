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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/site.css',
        'dist/css/base.css',
        'plugins/toastr/toastr.min.css',
        'plugins/emojionearea/emojionearea.min.css',
        'plugins/monthly/monthly.min.css',
        'plugins/amcharts/export.css',
        'dist/css/component_ui.min.css',
        'dist/css/custom.css',
        'datepicker/datepicker3.css',
        'select2/select2.min.css',
        'dist/css/base.css',
        'dist/css/custom.css',
        'plugins/modals/modal-component.css',
        'dist/css/component_ui.min.css',
    ];
    public $js = [
        'plugins/jquery-ui-1.12.1/jquery-ui.min.js',
      //  'bootstrap/js/bootstrap.min.js',
        'plugins/bootsnav/js/bootsnav.min.js',
        'plugins/lobipanel/lobipanel.min.js',
        'plugins/animsition/js/animsition.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.min.js',
        'plugins/toastr/toastr.min.js',
        'plugins/sparkline/sparkline.min.js',
        'plugins/counterup/jquery.counterup.min.js',
        'plugins/counterup/waypoints.js',
        'plugins/emojionearea/emojionearea.min.js',
        'plugins/monthly/monthly.min.js',
        'plugins/amcharts/amcharts.js',
        'plugins/amcharts/ammap.js',
        'plugins/amcharts/worldLow.js',
        'plugins/amcharts/serial.js',
        'plugins/amcharts/export.min.js',
        'plugins/amcharts/dark.js',
        'plugins/amcharts/pie.js',
        'dist/js/dashboard.js',
        'datepicker/bootstrap-datepicker.js',
        'select2/select2.full.min.js',
        'plugins/modals/classie.js',
        'plugins/modals/modalEffects.js',
        'plugins/Nestable/jquery.nestable.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
