<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Districts $model */

$this->title = Yii::t('app', 'Create Districts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="districts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
