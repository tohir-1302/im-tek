<?php

use app\models\Classes;
use app\models\Sciences;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/** @var yii\web\View $this */
/** @var app\models\TestsNames $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tests-names-form">

    <?php $form = ActiveForm::begin(); ?>
    <!-- <math-field id ="mf" virtual-keyboard-mode="manual" class="form_input_styles__">
        salom&ensp;salom
    </math-field> -->
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class'=>"form_input_styles__"]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'classes_id')->widget(Select2::classname(), [
            'data' => Classes::getList(),
            'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__"],
            'pluginOptions' => [
                'allowClear' => false
            ],
            ]); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'sciences_id')->widget(Select2::classname(), [
                        'data' => Sciences::getList(),
                        'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__"],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
            ]); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'question_count')->textInput(['maxlength' => true, 'class'=>"form_input_styles__"]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'begin_date')->textInput(['maxlength' => true, 'class'=>"form_input_styles__"]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'time_limit')->textInput(['maxlength' => true, 'class'=>"form_input_styles__"]) ?>
        </div>
        <div class="col-lg-4">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
