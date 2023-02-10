<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\ClientAsset;
use yii\bootstrap5\Html;

ClientAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<div class="top__menu">
    <div class="logo__img">
        <?= Html::a('<h2>Im-<span>TEK</span></h2>', Yii::$app->getUrlManager()->createUrl(['home'])); ?>
    </div>
    <div class="buttons_left">
        <a href="#">Imtihonlar</a>
        <a href="#">Balans</a>
        <a href="#">Yordam</a>
        <a href="#" title="Shaxsiy kabinet" class="kabinet__"><img src="https://img.icons8.com/officel/80/null/administrator-male.png"/> </a>

    </div>
</div>

<?php $this->beginBody() ?>
        
    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

