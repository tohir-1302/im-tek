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
<body>
    <div class="bloc__" style="height: 100%">
    <div class="im_tek_img">
                <img style="width: 160px; float: right; margin-right: 20px;  border-radius: 50% !important;" src="<?=Yii::getAlias("@img")?>/logo.png" alt="">
            </div>
        <div class="text__bloc">
         
            <div class="im_tek_jamoa">
               <b style=" text-shadow:
                            1px 1px 0px #FFC400,
                            2px 2px 0px #0000FF,
                            3px 3px 0px #0000FF,
                            4px 4px 0px #FFC400,
                            5px 5px 0px #FFC400;
                            transition: .5s ease-in-out;"> IM-TEK jamoasi tomonidan </b>
            </div>

            <div class="respublika">
                <b style=" text-shadow:
                            1px 1px 0px #FFC400,
                            2px 2px 0px #0000FF,
                            3px 3px 0px #0000FF,
                            4px 4px 0px #FFC400,
                            5px 5px 0px #FFC400;
                            transition: .5s ease-in-out;">Respublika miqiyosida o<span style="font-family: 'Times New Roman', Times, serif;">‘</span>tkazilgan  </b>
            </div>

            <div class="fan">
                <b style=" text-shadow:
                            1px 1px 0px #FFC400,
                            2px 2px 0px #0000FF,
                            3px 3px 0px #0000FF,
                            4px 4px 0px #FFC400,
                            5px 5px 0px #FFC400;
                            transition: .5s ease-in-out;"> olimpiadada <?= $test_sing_up['fan'] ?>  fanidan </b>
            </div>

            <div class="vil__tuman">
                <b style="  text-shadow:
                            1px 1px 0px #FFC400,
                            2px 2px 0px #0000FF,
                            3px 3px 0px #0000FF,
                            4px 4px 0px #FFC400,
                            5px 5px 0px #FFC400;
                            transition: .5s ease-in-out;"> muvaffaqiyatli ishtiroki uchun <br> <?= $test_sing_up['viloyat'] ?> <?= $test_sing_up['tuman'] ?>idan</b>
            </div>

            <div class="ism_fam">
                <b><?= $test_sing_up['fio']  ?></b>
            </div>
        </div>
        <div class="ratio">SERTIFIKAT</div>
        <div class="bilan" style="  text-shadow:
                            1px 1px 0px #FFC400,
                            2px 2px 0px #0000FF,
                            3px 3px 0px #0000FF,
                            4px 4px 0px #FFC400,
                            5px 5px 0px #FFC400;
                            transition: .5s ease-in-out;     color: #FFC400;
        font-size: 35px;
        text-align: center;
        font-family: monospace;
        ">
           <b> bilan taqdirlanadi. </b>
        </div>
        <div class="qrcode">
           <img src = "https://chart.googleapis.com/chart?cht=qr&chl=https://im-tek.uz/site/sertificate?test_singup_id=<?= $test_sing_up['id'] ?>&chs=160x160&chld=L|0"
            class="qr-code img-thumbnail img-responsive" /> 
            <div class="ball">
                <b>Ball: <?= pul2($test_sing_up['answer_success'] / $test_sing_up['question_count'] * 100,1) ?> % </b>
            </div>
        </div>
       
    </div>
    <div class="date_test">
            <?= dateView(date("Y-m-d",strtotime($test_sing_up['end_test_date'])))?>
        </div>
<style>
    .date_test{
        text-align: center;
        font-weight: bold;
        text-decoration:underline;
        font-family: monospace;
        font-size: 20px;
        margin-top: -100px;
    }

    .ball{
        font-size: 16px;
        font-weight: 650;
        text-align: center;
    }

    .bilan{
        font-size: 25px;
        text-align: center;
        font-family: monospace;
        margin-top: -50px;
    }

    .qr-code {
      max-width: 150px;
    }

    .qrcode{
        margin: 50px;
        width: 150px;
        border-radius: 12px;
        border: 5px solid #0000FF;
        margin-top: 10px;
        box-shadow:
                -1px -1px 0px #9AA8FF,
                -2px -2px 0px #C4CCFF,
                -3px -3px 0px #C4CCFF,
                1px 1px 0px #9AA8FF,
                2px 2px 0px #C4CCFF,
                3px 3px 0px #C4CCFF;
    }
    .ism_fam{
        /* text-decoration: underline; */
        font-style: italic;
        color: #000000;
        text-shadow:
                -1px -1px 0px #CAC702,
                -2px -2px 0px #CBCA91,
                1px 1px 0px #CAC730,
                2px 2px 0px #C7C679;
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
        color: #FFC400;
        background-color: rgba(255, 255, 254, .5);
        border-radius: 12px;
        font-size: 30px;
        text-align: center;
        font-family: monospace;
        font-weight: 900;
        letter-spacing: 5px;

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
        color: #FFC400;
        text-shadow:
        -1px 1px 0 #FFC400,
        -4px 4px 0 #FFC400,
        -5px 5px 0 #FFC400,
        -6px 6px 0 #0226FF,
        -7px 7px 0 #2341FD,
        -8px 8px 0 #435EFE,
        -9px 9px 0 #667CFF,
        -10px 10px 0 #9AA8FF,
        -11px 11px 0 #B3BEFF ,
        -12px 12px 0 #C4CCFF,
        -13px 13px 0 #DCE1FF,
        -14px 14px 0 #F1F3FF;
        
        transition: all .1s ;
        line-height: 240px;
    }

</style>