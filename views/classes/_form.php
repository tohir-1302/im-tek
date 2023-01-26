<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Classes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="classes-form">

    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method'=> 'post',
        'options' => [
            'data-pjax' => 1
        ]
    ]); ?>
    <div class="row">
        <div class="col-lg-3">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Sinf nomi'])->label(false) ?>
        </div>
        <div class="col-lg-2">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
