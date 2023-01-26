<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\QuestionsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="questions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tests_names_id') ?>

    <?= $form->field($model, 'option_A') ?>

    <?= $form->field($model, 'option_B') ?>

    <?= $form->field($model, 'option_C') ?>

    <?php // echo $form->field($model, 'option_D') ?>

    <?php // echo $form->field($model, 'answer_option') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
