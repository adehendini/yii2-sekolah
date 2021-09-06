<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-green sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?php require('_header.php'); ?>
    <?php require('_sidebar.php'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1><?= $this->title; ?></h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </section>
    </div>
    <?php require("_footer.php"); ?>   
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
