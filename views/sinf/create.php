<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sinf $model */

$this->title = 'Create Sinf';
$this->params['breadcrumbs'][] = ['label' => 'Sinfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sinf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
