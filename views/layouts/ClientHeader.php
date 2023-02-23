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
$url__ =Yii::$app->controller->id ."/". Yii::$app->controller->action->id;
// prd($url__);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">  
    <!-- on your view layout file HEAD section -->
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
    <script defer src="//unpkg.com/mathlive"></script>
</head>
<body>

<div class="top__menu">
    <div class="logo__img">
        <a href="<?= Yii::$app->getUrlManager()->createUrl(['home']);?>"><img src="<?=Yii::getAlias("@img")?>/logo_im_tek.png" class="image" alt="" /></a>
    </div>
    <div class="buttons_left">
        <?= Html::a('Sinflar', Yii::$app->getUrlManager()->createUrl(['classes/index']),['class' => "". $url__ == 'classes/index' ?  "active__" : ""]); ?>
        <?= Html::a('Fanlar', Yii::$app->getUrlManager()->createUrl(['sciences/index']),['class' => "". $url__ == 'sciences/index' ?  "active__" : ""]); ?>
        <?= Html::a('Test yaratish', Yii::$app->getUrlManager()->createUrl(['tests-names/index']), ['class' => "". $url__ == 'tests-names/index' ?  "active__" : ""]); ?>
        <?= Html::a('Imtihonlar', Yii::$app->getUrlManager()->createUrl(['home']), ['class' => "". $url__ == 'home/index' ?  "active__" : ""]); ?>
        <?= Html::a('Balans', Yii::$app->getUrlManager()->createUrl(['home'])); ?>
        <?= Html::a('Yordam', Yii::$app->getUrlManager()->createUrl(['home'])); ?>
        <?= Html::a('<img src="https://img.icons8.com/officel/80/null/administrator-male.png"/>', Yii::$app->getUrlManager()->createUrl(['home']),['title' => 'Shaxsiy kabinet', 'class' => 'kabinet__']); ?>
    </div>
</div>

<?php $this->beginBody() ?>
<div class="content__">
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
