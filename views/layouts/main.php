
<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
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
<body class="crm_body_bg">
<?php $this->beginBody() ?>

<nav class="sidebar dark_sidebar">
        <div class="logo d-flex justify-content-between">
            <a class="large_logo" href="<?= Yii::$app->getUrlManager()->createUrl(['home/index']) ?>"><img src="<?=Yii::getAlias("@img")?>/logo.png" alt=""></a>
            <a class="small_logo" href="<?= Yii::$app->getUrlManager()->createUrl(['home/index']) ?>"><img src="<?=Yii::getAlias("@img")?>/mini_logo.png" alt=""></a>
            <div class="sidebar_close_icon d-lg-none">
                <i class="ti-close"></i>
            </div>
        </div>
        <ul id="sidebar_menu">
           <?php  if ($user->role == 1) :?>
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
                        <span>Test yaratish</span>
                    </div>
                </a>
            </li>
            <?php endif; ?>
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
                                <div class="page_date_button d-flex align-items-center">
                                    <img src="<?=Yii::getAlias("@img")?>/icon/calender_icon.svg" alt="">
                                    <?= dateView(date("Y-m-d")) ?><br>
                                    <?= (date("H:i")) ?>
                                </div>
                        </div>
                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="header_notification_warp d-flex align-items-center">
                                <li>
                                    <a class="bell_notification_clicker" href="#"> <img src="<?=Yii::getAlias("@img")?>/icon/bell.svg" alt="">
                                        <span>2</span>
                                    </a>

                                    <div class="Menu_NOtification_Wrap">
                                        <div class="notification_Header">
                                            <h4>Notifications</h4>
                                        </div>
                                        <div class="Notification_body">

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="<?=Yii::getAlias("@img")?>/staf/2.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Cool Marketing </h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="<?=Yii::getAlias("@img")?>/staf/4.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Awesome packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="<?=Yii::getAlias("@img")?>/staf/3.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>what a packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="<?=Yii::getAlias("@img")?>/staf/2.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Cool Marketing </h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="<?=Yii::getAlias("@img")?>/staf/4.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Awesome packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="<?=Yii::getAlias("@img")?>/staf/3.png" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>what a packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nofity_footer">
                                            <div class="submit_button text-center pt_20">
                                                <a href="#" class="btn_1">See More</a>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li>
                                    <a class="CHATBOX_open" href="#"> <img src="<?=Yii::getAlias("@img")?>/icon/msg.svg" alt=""> <span>2</span>
                                    </a>
                                </li>
                            </div>
                            <div class="profile_info">
                                <img src="<?=Yii::getAlias("@img")?>/client_img.png" alt="#">
                                <div class="profile_info_iner">
                                    <div class="profile_author_name">
                                        <p style="border-bottom: solid 2px white;"><?= $user->username; ?></p>
                                        <h5><?= $user->full_name; ?></h5>
                                    </div>
                                    <div class="profile_info_details">
                                        <a href="#">Mening profilim</a>
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
<?php $this->endPage() ?>
