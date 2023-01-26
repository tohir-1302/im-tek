<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sciences $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sciences-form">

<?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method' => 'post',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-lg-3">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Fan nomi'])->label(false) ?>
        </div>   
        <div class="col-lg-2">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div><br><br><br><br>
    </div>

   

    <?php ActiveForm::end(); ?>

</div>
