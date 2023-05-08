<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>Sertificat</title>
</head>
<body>
    <div class="bloc__" style="height: 100%">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="text__bloc">
            <div class="text_sertificat">
                <b>
                    <?= $test_sing_up['fan'] ?>  fanidan <br> 
                    muvaffaqiyatli ishtiroki uchun <br>
                    <?= $test_sing_up['viloyat'] ?> <?= $test_sing_up['tuman'] ?>idan
                </b>
            </div>
            <div class="ism_fam">
                <b><?= $test_sing_up['fio']  ?></b>
            </div>
        </div>
        <div class="ball">
            <b>Natija: <?= pul2($test_sing_up['answer_success'] / $test_sing_up['question_count'] * 100,1) ?> % </b>
        </div>
        <div class="t_j_s">
            <b>
                To'g'ri javoblar: <?= ($test_sing_up['answer_success']) ?> <br>
                Noto'g'ri javoblar: <?= ($test_sing_up['question_count'] - $test_sing_up['answer_success']) ?> 
             </b>
        </div>
        <div class="date_test">
            <b><?= dateView(date("Y-m-d",strtotime($test_sing_up['end_test_date'])))?></b>
        </div>
        <div class="qrcode">
           <img src = "https://chart.googleapis.com/chart?cht=qr&chl=https://im-tek.uz/site/sertificate?test_singup_id=<?= $test_sing_up['id'] ?>&chs=160x160&chld=L|0"
            class="qr-code img-thumbnail img-responsive" /> 
          
        </div>
      
    </div>
  
<style>
    .text__bloc{
        text-align: center;
        font-size: 30px;
        font-family: monospace;
        margin-top: -20px;
    }

    .ism_fam{
        font-family: Arial, Helvetica, sans-serif;
        color: #0d4057;
    }

    .qr-code {
      max-width: 80px;
    }

    .date_test{
        text-align: right;
        margin-right: 305px;
        margin-top: -77px;
        position: absolute;
        color: #0d4057;
        font-size: 20px;
    }

    .ball, .t_j_s{
        text-align: left;
        margin-left: 325px;
        position: absolute;
        color: #0d4057;
    }

    .ball{
        margin-top: 90px;
        font-size: 20px;
    }

    .t_j_s{
        margin-top: 12px;
    }
    .qrcode{
        margin-right: 305px;
        width: 80px;
        border-radius: 12px;
        border: 3px solid #0d4057;
        margin-top: 17px;
        float: right;
        text-align: center;
        color: #0d4057;
    }
  
    .bloc__{
        background-image: url("<?=Yii::getAlias("@img")?>/sertifikat.png");
        background-attachment: fixed;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        border: 15px solid #0d4057;
    }

</style>