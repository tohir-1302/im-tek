<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TestsNames $model */

$this->title = 'Update Tests Names: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests Names', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tests-names-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
