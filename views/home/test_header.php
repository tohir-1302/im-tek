<?php  
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<h3><?= $result['test_name'] ?></h3>
    <div class="right__header">
        <div class="end__time">
            <div class="time_" style="display: none;">
                <?= $result['time'] ?>
            </div>
            <br>
            <br>
            <div class="hours">
                00
            </div>
            :
            <div class="minut">
                00
            </div>
            :
            <div class="secund">
                00
            </div>
        </div>
    </div>
    <div class="end__test">
        <?php
            $form = ActiveForm::begin([
                'action' => ['home/end-test'],
                'method'=> 'post',
                'options' => [
                    'data-pjax' => 1
                ]]); ?>
            <?= Html::hiddenInput('test_singup_id', $result['question']['test_sing_up_id']); ?>
            <?= Html::submitButton('Tugatish', ['class' =>"btn_1 "]) ?>
        <?php ActiveForm::end(); ?> 
    </div>