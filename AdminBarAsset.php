<?php

namespace denisok94\admin;

use yii\web\AssetBundle;

class AdminBarAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@denisok94/admin/assets';
    /**
     * @inheritdoc
     */
    public $css = [
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'app.js',
        'helper.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}