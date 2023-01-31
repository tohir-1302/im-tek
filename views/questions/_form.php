<?php

use app\models\Questions;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Questions $model */
/** @var yii\widgets\ActiveForm $form */
?>
    <div class="form_create">
        <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-lg-12 blox_create">
                    <?= $form->field($model, 'question')->textarea(['rows' => 1]) ?>
                    <math-field id ="question_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create ">
                    <?= $form->field($model, 'option_A')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_a_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'option_B')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_b_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'option_C')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_c_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'option_D')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_d_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'answer_option')->widget(Select2::classname(), [
                                                'data' => Questions::getAnswerQuestion(),
                                                'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__"],
                                                'pluginOptions' => [
                                                    'allowClear' => false
                                                ],
                                                ]); ?>
                </div>
                <div class="col-sm-2">
                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
