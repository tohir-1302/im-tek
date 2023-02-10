<?php

use app\models\Classes;
use app\models\Sciences;
use kartik\datetime\DateTimePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\time\TimePicker;

/** @var yii\web\View $this */
/** @var app\models\TestsNames $model */
/** @var kartik\form\ActiveForm $form */
?>

<div class="tests-names-form">

    <?php $form =ActiveForm::begin(); ?>

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
            <?= $form->field($model, 'begin_date')->widget(DateTimePicker::classname(), [
                                                    'options' => ['placeholder' => 'Belgilang ...'],
                                                    'pluginOptions' => [
                                                        'autoclose' => true
                                                    ]
                                                    ]);?>
        </div>       
         <div class="col-lg-4">
            <?= $form->field($model, 'end_date')->widget(DateTimePicker::classname(), [
                                                    'options' => ['placeholder' => 'Belgilang ...'],
                                                    'pluginOptions' => [
                                                        'autoclose' => true
                                                    ]
                                                    ]);?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'time_limit')->widget(TimePicker::classname(),[
                                                'name' => 't1',
                                                'pluginOptions' => [
                                                    'showSeconds' => true,
                                                    'showMeridian' => false,
                                                    'minuteStep' => 20,
                                                    'secondStep' => 13,
                                                ]])
             ?>
        </div>
        <div class="col-lg-4">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
