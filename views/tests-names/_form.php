<?php

use app\models\Classes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestsNames $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tests-names-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classes_id')->dropDownList(Classes::getList(),['class' => 'form-control select2', 'prompt' => 'Выберите']) ?>

    <?= $form->field($model, 'sciences_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
