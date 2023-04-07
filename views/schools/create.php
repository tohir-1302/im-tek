<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Schools $model */

$this->title = Yii::t('app', 'Create Schools');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
