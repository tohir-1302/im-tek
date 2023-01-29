<?php

function pr($variable)
{
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
}

/**
 * <pre>$var</pre>;die();
 */
function prd($variable)
{
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
    die;
}

function pul($value, $fixed)
{
    return number_format($value, $fixed, '.', ' ');
}

function pul2($value, $fixed)
{
    return number_format($value, $fixed, ',', ' ');
}

// view da 12.04.2018 shaklida chiqarish uchu
function dateView($date)
{
    return Yii::$app->formatter->asDate($date, 'php:d.m.Y');
}

// bazaga saqlash uchun 2018-04-12 shaklida
function dateBase($date)
{
    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
}


// data ni vaqti bilan korsatish uchun
function datetimeView($date)
{
    $date = explode(' ', $date);
    return Yii::$app->formatter->asDate($date[0], 'php:d.m.Y') . ' ' . $date[1];
}


?>