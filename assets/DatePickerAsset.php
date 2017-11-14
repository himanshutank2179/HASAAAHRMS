<?php
namespace app\assets;

use yii\web\AssetBundle;

class DatePickerAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $css = [
        'plugins/datepicker/datepicker3.css',
    ];
    public $js = [
        'plugins/datepicker/bootstrap-datepicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}