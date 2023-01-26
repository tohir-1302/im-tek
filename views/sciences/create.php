<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sciences $model */

$this->title = 'Create Sciences';
$this->params['breadcrumbs'][] = ['label' => 'Sciences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sciences-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
