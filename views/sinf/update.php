<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sinf $model */

$this->title = 'Update Sinf: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sinfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sinf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
