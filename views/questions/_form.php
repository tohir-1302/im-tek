<?php

use app\models\Questions;
use kartik\file\FileInput;
use kartik\form\Bs4CustomFileInputAsset;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Questions $model */
/** @var yii\widgets\ActiveForm $form */
?>
    <div class="form_create">
        <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-lg-12 blox_create" style="margin-bottom: 10px; border-bottom: 1px solid black;">
                    <?= $form->field($model, 'question')->textarea(['rows' => 1]) ?>
                    <div class="click__buttons_">
                        <div class="btn btn-dark" id="question__formula">Formula kiritish</div>
                        <div class="btn btn-dark" id="question__file_button">Rasm biriktirish</div>
                    </div>
                    <div class="formula_question">
                        <math-field id ="question_math" virtual-keyboard-mode="manual" letter-shape-style="upright"  class="form_input_styles__">
                        </math-field>
                        <div class="btn btn-success" id="question__formula__save">Saqlash</div>
                    </div>
                    <div class="question__file">
                        <?=  $form->field($model, 'file')->widget(FileInput::classname(), [
                            'options' => ['multiple' => true, 'accept' => "image/png, image/gif, image/jpeg, image/jpg"],
                            'pluginOptions' => ['previewFileType' => 'image']
                        ]) ->label("3 tagacha rasm yuklash mumkin !!!"); ?>
                    </div>
                </div>
                <div class="col-sm-6 blox_create ">
                    <?= $form->field($model, 'option_A')->textarea(['rows' => 1]) ?>
                    <div class="btn btn-dark" id="option_a__formula">Formula kiritish</div>
                    <div class="formula_option_a">
                        <math-field id ="option_a_math" virtual-keyboard-mode="manual" letter-shape-style="upright"  class="form_input_styles__">
                        </math-field>
                        <div class="btn btn-success" id="option_a__formula__save">Saqlash</div>
                    </div>
                </div>
                <div class="col-sm-6 blox_create">
                    <?= $form->field($model, 'option_B')->textarea(['rows' => 1]) ?>
                    <div class="btn btn-dark" id="option_b__formula">Formula kiritish</div>
                    <div class="formula_option_b">
                        <math-field id ="option_b_math" virtual-keyboard-mode="manual" letter-shape-style="upright"  class="form_input_styles__">
                        </math-field>
                        <div class="btn btn-success" id="option_b__formula__save">Saqlash</div>
                    </div>
                </div>
                <div class="col-sm-6 blox_create">
                    <?= $form->field($model, 'option_C')->textarea(['rows' => 1]) ?>
                    <div class="btn btn-dark" id="option_c__formula">Formula kiritish</div>
                    <div class="formula_option_c">
                        <math-field id ="option_c_math" virtual-keyboard-mode="manual" letter-shape-style="upright"  class="form_input_styles__">
                        </math-field>
                        <div class="btn btn-success" id="option_c__formula__save">Saqlash</div>
                    </div>
                </div>
                <div class="col-sm-6 blox_create">
                    <?= $form->field($model, 'option_D')->textarea(['rows' => 1]) ?>
                    <div class="btn btn-dark" id="option_d__formula">Formula kiritish</div>
                    <div class="formula_option_d">
                        <math-field id ="option_d_math" virtual-keyboard-mode="manual" letter-shape-style="upright"  class="form_input_styles__">
                        </math-field>
                        <div class="btn btn-success" id="option_d__formula__save">Saqlash</div>
                    </div>
                </div>
                <div class="col-sm-12 blox_create">
                    <?= $form->field($model, 'answer_option')->widget(Select2::classname(), [
                                                'data' => Questions::getAnswerQuestion(),
                                                'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__"],
                                                'pluginOptions' => [
                                                    'allowClear' => false
                                                ],
                                                ]); ?>
                </div>
                <div class="col-sm-12">
                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style' => "width: 100%; height: 50px;"]) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
    ob_start();
    include "mathlive.js";
    $script = ob_get_clean();
    $this->registerJs($script);
?>
<br>
<style>
    .question__file, .formula_question, .formula_option_a, .formula_option_b, .formula_option_c, .formula_option_d{
        display: none;
        /* display: flex; */
    }

    .click__buttons_{
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }


</style>