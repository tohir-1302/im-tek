<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Questions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>
    <math-field id ="mf" virtual-keyboard-mode="manual" style="font-size: 32px; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);">

    </math-field>
    <?= $form->field($model, 'tests_names_id')->textInput() ?>

    <?= $form->field($model, 'option_A')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'option_B')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'option_C')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'option_D')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'answer_option')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
