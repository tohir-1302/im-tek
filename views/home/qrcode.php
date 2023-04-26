<?php

use yii\web\Response;

    $qr = Yii::$app->get('qr');

    Yii::$app->response->format = Response::FORMAT_RAW;
    Yii::$app->response->headers->add('Content-Type', $qr->getContentType());
    
    return $qr
        ->setText('https://2amigos.us')
        ->setLabel('2amigos consulting group llc')
        ->writeString();
?> 