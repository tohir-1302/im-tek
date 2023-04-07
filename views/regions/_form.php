<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Regions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="regions-form">
   
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-10">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

   

    <?php ActiveForm::end(); ?>

</div>
