<?php
namespace app\assets;

use yii\web\AssetBundle;

class SelectAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $css = [
        'plugins/select2/select2.min.css',
    ];
    public $js = [
        'plugins/select2/select2.full.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}