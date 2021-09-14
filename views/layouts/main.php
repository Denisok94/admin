<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

//проверка кук
if (isset($_COOKIE['skin'])) {
    $skin  = $_COOKIE['skin'];
} else {
    $skin = "blue";
};
if (isset($_COOKIE['sidebar'])) {
    $coll  = $_COOKIE['sidebar'];
} else {
    $coll = "false";
};

app\assets\AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
denisok94\admin\AdminBarAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition skin-<?php echo $skin; ?> sidebar-mini <?php if ($coll != "false") echo "sidebar-collapse"; ?>">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>