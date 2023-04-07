<?php

use app\models\Regions;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Districts $model */
/** @var yii\widgets\ActiveForm $form */
?>
<hr>
<div class="districts-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'regions_id')->widget(Select2::className(), [
                        'data' => Regions::getList(),
                        'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__" , ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
            ]); ?>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success' , 'style' => 'margin-top: 20px']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<hr><br>