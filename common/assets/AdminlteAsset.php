<?php
 namespace common\assets;

use yii\web\AssetBundle;

class AdminlteAsset extends AssetBundle
{
    public $sourcePath = '@app/../themes';

    public $css = [
        'adminlte/css/AdminLTE.min.css',
        'adminlte/css/skins/_all-skins.css',
        'adminlte/bootstrap/css/bootstrap.min.css',
    ];

    public $js = [
        'adminlte/js/app.min.js',
        'adminlte/bootstrap/js/bootstrap.min.js',
    ];
}

