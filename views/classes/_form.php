<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Classes $model */
/** @var yii\widgets\ActiveForm $form */
?>


    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method'=> 'post',
        'options' => [
            'data-pjax' => 1
        ]
    ]); ?>
    <div class="serach_field_2">
        <div class="search_inner">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Yangi sinf qo`shish', 'class' => 'search_field'])->label(false) ?>
        </div>
         <?= Html::submitButton('Saqlash', ['class' => 'btn_1']) ?>
    </div>
   
           
           
    
    <?php ActiveForm::end(); ?>

