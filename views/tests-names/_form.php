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
        <div class="col-lg-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class'=>"form_input_styles__", ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'classes_id')->widget(Select2::classname(), [
            'data' => Classes::getList(),
            'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__", ],
            'pluginOptions' => [
                'allowClear' => false
            ],
            ]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'sciences_id')->widget(Select2::className(), [
                        'data' => Sciences::getList(),
                        'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__" , ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
            ]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'question_count')->textInput(['maxlength' => true, 'class'=>"form_input_styles__", ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'begin_date')->widget(DateTimePicker::classname(), [
                                                    'options' => ['placeholder' => 'Belgilang ...', ],
                                                    'pluginOptions' => [
                                                        'autoclose' => true
                                                    ]
                                                    ]);?>
        </div>       
         <div class="col-lg-4">
            <?= $form->field($model, 'end_date')->widget(DateTimePicker::classname(), [
                                                    'options' => ['placeholder' => 'Belgilang ...', ],
                                                    'pluginOptions' => [
                                                        'autoclose' => true
                                                    ]
                                                    ]);?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'time_limit')->widget(TimePicker::classname(),[
                                                'name' => 't1',
                                                'options' => [],
                                                'pluginOptions' => [
                                                    'showSeconds' => true,
                                                    'showMeridian' => false,
                                                    'minuteStep' => 20,
                                                    'secondStep' => 13,
                                                ]])
             ?>
        </div>
     
    </div>
    <hr>
    <div class="boshqa_bloc">
        <div class="row" style="margin-right: 50px;">
            <div class="col-lg-6">
                <?= $form->field($model, 'sertificat_status')->widget(Select2::className(), [
                            'data' => [1 => 'Berilmaydi', 2 => 'Beriladi'],
                            'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__" , ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                ]); ?>
            </div>
        

            <div class="col-lg-6">
                <?= $form->field($model, 'sertifikat_foiz')->textInput(['maxlength' => true, 'class'=>"form_input_styles__", ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4" >
                <p class="maxsus_test">Maxsus test</p>
                <?= $form->field($model, 'has_special_test')->checkbox(['id' => 's2', 'class' => 'switch'])->label(false) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'special_test_password')->textInput(['maxlength' => true, 'class'=>"form_input_styles__"]) ?>
            </div>
        </div>
    </div>
  

    <div class="row">
        <div class="col-lg-12">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width: 100%']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    .boshqa_bloc{
        display: flex;
    }
    .maxsus_test{
        font-size: 14px;
        color: black;
        margin-bottom: 10px;
    }
</style>