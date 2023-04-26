<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Sertificat</title>
</head>
<?php

use app\models\Districts;
use app\models\Regions;
use app\models\Sciences;

$fan = Sciences::getList();
$user = Yii::$app->user->identity;
$viloyat = Regions::getList();
$tuman = Districts::getListAll();
?>
<body>
    <div class="bloc__" style="height: 100%">
    <div class="im_tek_img">
                <img style="width: 160px; float: right; margin-right: 20px;  border-radius: 50% !important;" src="<?=Yii::getAlias("@img")?>/logo.png" alt="">
            </div>
        <div class="text__bloc">
         
            <div class="im_tek_jamoa">
               <b style=" text-shadow: 0 0 13px #FF0000, 0 0 15px #0000FF;"> IM-TEK jamoasi tomonidan </b>
            </div>

            <div class="respublika">
                <b style=" text-shadow: 0 0 13px #FF0000, 0 0 15px #0000FF;">Respublika miqiyosida o'tkazilgan olimpiadada </b>
            </div>

            <div class="fan">
                <b style=" text-shadow: 0 0 13px #FF0000, 0 0 15px #0000FF;"><?= $fan[$tets_names['sciences_id']] ?> fanidan muvaffaqiyatli ishtiroki uchun</b>
            </div>

            <div class="vil__tuman">
                <b style="  text-shadow: 0 0 13px #FF0000, 0 0 15px #0000FF;"><?= $viloyat[$user->regions_id]?> <?= $tuman[$user->districts_id] ?></b>
            </div>

            <div class="ism_fam">
                <b  style="  text-shadow: 0 0 13px #FF0000, 0 0 15px #0000FF;"><?= $user->last_name . " " . $user->first_name . " " . $user->father_is_name ?></b>
            </div>
        </div>
        <div class="ratio">SERTIFIKAT</div>
        <div class="bilan">
            bilan taqdirlanadi.
        </div>
        <div class="qrcode">
           <img src = "https://chart.googleapis.com/chart?cht=qr&chl=https://im-tek.uz/site/sertificate?test_singup_id=<?= $test_sing_up['id'] ?>/&chs=160x160&chld=L|0"
            class="qr-code img-thumbnail img-responsive" /> 
            <div class="ball">
                <b>Ball: <?= pul2($test_sing_up['answer_success'] / $test_sing_up['question_count'] * 100,1) ?> % </b>
            </div>
        </div>
    </div>
<style>

    .ball{
        font-size: 16px;
        font-weight: 650;
        text-align: center;
        margin-top: -7px;
    }

    .bilan{
        font-size: 25px;
        text-align: center;
        font-family: monospace;
        margin-top: -20px;
    }

    .qr-code {
      max-width: 150px;
    }

    .qrcode{
        margin: 50px;
        width: 150px;
        border-radius: 12px;
        border: 5px solid #06065C;
    }

    .fan{
        text-decoration: underline;
    }

    .ism_fam{
        text-decoration: underline;
        font-style: italic;
        color: hsl(260, 100%, 20%);
    }
    
    .sertificat h1 {
        color: #FFC400;
        text-shadow:0 1px 0 hsl(240, 100%, 60%),
                    0 2px 0 hsl(240, 100%, 65%),
                    0 3px 0 hsl(240, 100%, 70%),
                    0 4px 0 hsl(240, 100%, 60%),
                    0 5px 0 hsl(240, 100%, 70%),
                    0 6px 0 hsl(240, 100%, 70%),
                    0 7px 0 hsl(240, 100%, 70%),
                    0 8px 0 hsl(240, 100%, 70%),

                    0 0 5px rgba(0,0,0,.05),
	                0 1px 3px rgba(0,0,0,.2),
	                0 3px 5px rgba(0,0,0,.2),
	               0 5px 10px rgba(0,0,0,.2),
	              0 10px 10px rgba(0,0,0,.2),
	              0 20px 20px rgba(0,0,0,.3);
    }
    .bloc__{
        border: 2px red solid;
        /* background-color: rgba(28, 146, 244, .4); */
        background-image: url("<?=Yii::getAlias("@img")?>/sertificate.png");
        background-attachment: fixed;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }
   
    .text__bloc{
        color: #160134;
        background-color: rgba(255, 255, 254, .5);
        border-radius: 12px;
        font-size: 30px;
        margin-left: 70px;
        margin-right: 70px;
        text-align: center;
        font-family: monospace;
    }
    .sertificat h1{
        font-size: 80px;
    }
    .ratio {
        font-family: 'Catamaran', sans-serif;
        letter-spacing: 20px;
        font-weight: 900;
        max-width: 800px;
        margin-top: -50px;
        display: block;
        font-size: 100px;
        text-align: center;
        color: rgba(95, 192, 254, 0.6);
        text-shadow:
        -14px 14px 0 rgba(50, 153, 240, 0.4),		
        -1px 1px 0 #697075,
        -2px 2px 0 #0B0135,
        -3px 3px 0 #000000,
        -4px 4px 0 #0372b8,
        -5px 5px 0 #0372b8,
        -6px 6px 0 #0372b8,
        -7px 7px 0 #0372b8,
        -8px 8px 0 #0372b8,
        -9px 9px 0 #0372b8,
        -10px 10px 0 #0372b8,
        -11px 11px 0 #0372b8,
        -12px 12px 0 #0372b8,
        -13px 13px 0 #0372b8,
        -14px 14px 0 #0372b8;
        /* -15px 15px 35px rgba(0, 0, 0, 0.2),
        -35px 15px 10px rgba(0, 0, 0, 0.1); */
        transition: all .1s ;
        line-height: 240px;
    }

</style>