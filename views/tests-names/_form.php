<?php

use app\models\Classes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/** @var yii\web\View $this */
/** @var app\models\TestsNames $model */
/** @var yii\widgets\ActiveForm $form */
$data = [
    "red" => "red",
    "green" => "green",
    "blue" => "blue",
    "orange" => "orange",
    "white" => "white",
    "black" => "black",
    "purple" => "purple",
    "cyan" => "cyan",
    "teal" => "teal"
];
?>

<div class="tests-names-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classes_id')->widget(Select2::classname(), [
                'data' => Classes::getList(),
                'options' => ['placeholder' => 'Выберите'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]); ?>

    <?= $form->field($model, 'sciences_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
