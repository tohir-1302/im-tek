<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Questions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tests_names_id')->textInput() ?>

    <?= $form->field($model, 'option_A')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'option_B')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'option_C')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'option_D')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer_option')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
