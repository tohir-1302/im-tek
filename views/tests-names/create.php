<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TestsNames $model */

$this->title = 'Yangi test yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Tests Names', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-names-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
