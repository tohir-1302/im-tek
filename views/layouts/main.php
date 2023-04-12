
<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
// on your view layout file

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias("@img/mini_logo.png")]);
$url__ =Yii::$app->controller->id ."/". Yii::$app->controller->action->id;
$user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- on your view layout file HEAD section -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">  
    <!-- on your view layout file HEAD section -->
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>

    <script defer src="//unpkg.com/mathlive"></script>

    <link rel="stylesheet" href="https://unpkg.com/browse/mathlive@0.89.4/dist/mathlive-fonts.css">  

</head>
<body class="crm_body_bg" onload="myFunction()">
<?php $this->beginBody() ?>

<nav class="sidebar dark_sidebar">
        <div class="logo d-flex justify-content-between">
            <a class="large_logo" href="<?= Yii::$app->getUrlManager()->createUrl(['home/index']) ?>"><img src="<?=Yii::getAlias("@img")?>/logo_im_tek.png" alt=""></a>
            <a class="small_logo" href="<?= Yii::$app->getUrlManager()->createUrl(['home/index']) ?>"><img src="<?=Yii::getAlias("@img")?>/mini_logo.png" alt=""></a>
            <div class="sidebar_close_icon d-lg-none">
                <i class="ti-close"></i>
            </div>
        </div>
        <ul id="sidebar_menu">
           <?php  if (in_array($user->role,[User::Admin])) :?>
                <li class="">
                    <a class="<?= $url__ ==  'regions/index' ? 'active': '' ?> active" href="<?= Yii::$app->getUrlManager()->createUrl(['regions/index']) ?>" aria-expanded="false">
                        <div class="nav_icon_small">
                            <img src="<?=Yii::getAlias("@img")?>/menu-icon/regions.svg" alt="">
                        </div>
                        <div class="nav_title">
                            <span>Viloyatlar</span>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a class="<?= $url__ ==  'districts/index' ? 'active': '' ?> active" href="<?= Yii::$app->getUrlManager()->createUrl(['districts/index']) ?>" aria-expanded="false">
                        <div class="nav_icon_small">
                            <img src="<?=Yii::getAlias("@img")?>/menu-icon/districts.svg" alt="">
                        </div>
                        <div class="nav_title">
                            <span>Tumanlar</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php  if (in_array($user->role,[User::Admin, User::Teacher])) :?>
                <li class="">
                    <a class="<?= $url__ ==  'classes/index' ? 'active': '' ?> active" href="<?= Yii::$app->getUrlManager()->createUrl(['classes/index']) ?>" aria-expanded="false">
                        <div class="nav_icon_small">
                            <img src="<?=Yii::getAlias("@img")?>/menu-icon/classes.svg" alt="">
                        </div>
                        <div class="nav_title">
                            <span>Sinf</span>
                        </div>
                    </a>
                </li>
                
                <li class="">
                    <a href="<?= Yii::$app->getUrlManager()->createUrl(['sciences/index']) ?>" aria-expanded="false">
                        <div class="nav_icon_small">
                            <img src="<?=Yii::getAlias("@img")?>/menu-icon/scines.svg" alt="">
                        </div>
                        <div class="nav_title">
                            <span>Fanlar</span>
                        </div>
                    </a>
                </li>

                <li class="">
                    <a href="<?= Yii::$app->getUrlManager()->createUrl(['tests-names/index']) ?>" aria-expanded="false">
                        <div class="nav_icon_small">
                            <img src="<?=Yii::getAlias("@img")?>/menu-icon/test_create.svg" alt="">
                        </div>
                        <div class="nav_title">
                            <span>Testlar</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <?php  if (in_array($user->role,[User::Admin, User::Client])) :?>
                <li class="">
                    <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/index']) ?>" aria-expanded="false">
                        <div class="nav_icon_small">
                            <img src="<?=Yii::getAlias("@img")?>/menu-icon/test.svg" alt="">
                        </div>
                        <div class="nav_title">
                            <span>Imtihonlar</span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>


    <section class="main_content dashboard_part large_header_bg">

        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-lg-12 p-0 ">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <img src="https://img.icons8.com/ios/25/null/menu--v1.png"/>
                        </div>
                        <div class="line_icon open_miniSide d-none d-lg-block">
                            <img src="https://img.icons8.com/ios/25/null/menu--v1.png"/>
                        </div>
                        <div class="serach_field-area d-flex align-items-center">
                            <div class="page_date_button d-flex align-items-center" style="display: block;">
                                <img src="<?=Yii::getAlias("@img")?>/icon/calender_icon.svg" alt="">
                                <div class="date_time_all">
                                    <?= dateView(date("Y-m-d")) ?> <br>
                                    <div id="time__"> <?= (date("H:i:s")) ?> </div>
                                </div>
                            </div> 
                        </div>
                        <div class="header_right d-flex justify-content-between align-items-center" style="border-right: 2px #828bb2 solid; padding-right: 10px; margin-right: 10px;">
                            <div class="profile_info" style="text-align: center;">
                                <img style="border: none;" src="https://img.icons8.com/external-flatarticons-blue-flatarticons/65/null/external-Money-achievements-and-badges-flatarticons-blue-flatarticons.png"/>
                                <p style="font-weight: 650;"><?= pul2(50000,1) ?> so'm</p>

                                <div class="profile_info_iner">
                                    <div class="profile_author_name">
                                        <p style="border-bottom: solid 2px white;">Hisob: <?= pul2(50000,1) ?> so'm</p>
                                    </div>
                                    <div class="profile_info_details">
                                        <a href="<?= \yii\helpers\Url::to(['#']) ?>">Hisobga tushgan pullar</a>
                                        <a href="<?= \yii\helpers\Url::to(['#']) ?>" method="post">Sarflangan pullar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="profile_info" style="text-align: center;">
                                <img style="border: none;" src="https://img.icons8.com/external-others-inmotus-design/67/null/external-User-virtual-keyboard-others-inmotus-design-3.png"/>
                                <p style="font-weight: 650;"><?= $user->last_name . " ". $user->first_name ?></p>

                                <div class="profile_info_iner">
                                    <div class="profile_author_name">
                                        <p style="border-bottom: solid 2px white;"><?= $user->first_name; ?></p>
                                        <h5><?= $user->last_name; ?></h5>
                                    </div>
                                    <div class="profile_info_details">
                                        <a href="<?= \yii\helpers\Url::to(['users/my-profile']) ?>">Mening profilim</a>
                                        <a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" method="post">Chiqish</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30_">
                        <?= $content ?>
                    </div>
                </div>             
            </div>
        </div>

        <div class="footer_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_iner text-center">
                            <p>2023 © IM-TEK </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<script>
const myInterval = setInterval(myTimer, 1000);

function myTimer() {
  const date = new Date();
  document.getElementById("time__").innerHTML = date.toLocaleTimeString();
}

    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
         
        } else {
            document.querySelector(
            "#loader").style.display = "none";
           
        }
    };

</script>
<?php $this->endPage() ?>
