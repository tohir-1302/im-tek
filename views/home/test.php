<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use function PHPSTORM_META\type;
?>
<div class="time__test_name">
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

        <div class="end__test">
            <?php $form = ActiveForm::begin([
                    'action' => ['home/end-test'],
                    'method'=> 'post',
                    'options' => [
                        'data-pjax' => 1
                    ]]); ?>
                <?= Html::hiddenInput('test_singup_id', $result['question']['test_sing_up_id']); ?>
                <?= Html::submitButton('Tugatish', ['class' =>"btn_1 "]) ?>
            <?php ActiveForm::end(); ?> 
        </div>
    </div>

    
</div>


<input type="hidden" id="test_answer_id" name="custId" value="<?= $result['question']['id'] ?>">
<div class="wrapper">
    <div class="numbers__test">
        <?php foreach ($result['test_count'] as $number => $answer): 
             $yes_answwer =  $answer != 0 ? 'yes_answwer' : "";
             $active_test =  $number == $result['question']['number'] ? 'active_test' : '' ;
        ?>
            <?php $form = ActiveForm::begin([
                'action' => ['home/test'],
                'method'=> 'post',
                'options' => [
                    'data-pjax' => 1
                ]]); ?>
                <?= Html::hiddenInput('test_names_id', $result["tets_names_id"]); ?>
                <?= Html::hiddenInput('question_number', $number); ?>
            <?= Html::submitButton($number, ['class' =>"number__test " . $yes_answwer ." ". $active_test ]) ?>
            <?php ActiveForm::end(); ?>
        <?php endforeach; ?>
    </div>
</div>
<br>
<div class="wrapper">
    <div class="question">
        <math-field readonly id = 'question_text'> <?= $result['question']['question'] ?></math-field>
    </div>
 <input type="radio" name="select" id="option-1" <?= $result['question']['answer_client'] == 1 ? 'checked' : '' ?> >
 <input type="radio" name="select" id="option-2" <?= $result['question']['answer_client'] == 2 ? 'checked' : '' ?>>
 <input type="radio" name="select" id="option-3" <?= $result['question']['answer_client'] == 3 ? 'checked' : '' ?>>
 <input type="radio" name="select" id="option-4" <?= $result['question']['answer_client'] == 4 ? 'checked' : '' ?>>

    <label for="option-1" class="option option-1">
        <div class="dot"></div>
        <span><math-field readonly> <?= $result['question']['option_A'] ?></math-field></span>
    </label>

    <label for="option-2" class="option option-2">
        <div class="dot"></div>
        <span><math-field readonly> <?= $result['question']['option_B'] ?></math-field></span>
    </label>

    <label for="option-3" class="option option-3">
        <div class="dot"></div>
        <span><math-field readonly> <?= $result['question']['option_C'] ?></math-field></span>
    </label>

    <label for="option-4" class="option option-4">
        <div class="dot"></div>
        <span><math-field readonly> <?= $result['question']['option_D'] ?></math-field></span>
    </label>

</div>

<div class="test_singup_id" style="display: none;">
    <?= $result['question']['test_sing_up_id'] ?>
</div>
<?php
ob_start();
include "script.js";
$script = ob_get_clean();
$this->registerJs($script);
?>

<style>
    .end__test{
        margin: -10px;
        margin-right: 50px;
    }

    .end__time{
        display: flex;
        margin-right: 100px;
        font-size: 20px;
        font-weight: 650;
        font-family: monospace;
        color: #A41704 ;
    }
    .right__header{
        display: flex;
        vertical-align: middle;
    }
    .time__test_name{
        display: flex;
        justify-content: space-between;
    }
    .time__test_name h4 {
        display: flex;
    }
    .number__test{
        border: 1px solid #0069d9;
        padding: 6px 10px;
        margin-right: 10px;
        border-radius: 6px;
        background-color: none;
        color: black;
        font-weight: 650;
    }
    .question{
        font-size: 20px;
        font-weight: 550;
        width: 100%;
    }
    .wrapper .option span{
        font-size: 16px;
        color: #808080;
        font-weight: 550;
    }
    .number__test:hover{
        box-shadow: 0px 0px 10px #0069d9;
    }

    .numbers__test .active_test{
        color: white;
        background-color: #0069d9;
        border-color: #0069d9;

    }

    .yes_answwer{
        color: white;
        background-color: #0BAB12;
        border-color: #0BAB12;
    }

    .yes_answwer:hover, .active_test:hover {
        color: white;
        background-color: #0069d9;
    }
    .numbers__test{
        display: flex;
    }
    .wrapper{
        overflow-x: auto;
        display: bloc;
        background: #fff;
        height: auto;
        width: 100%;
        align-items: center;
        justify-content: space-evenly;
        border-radius: 5px;
        padding: 20px 15px;
        padding-right: 50px;
        box-shadow: 5px 5px 30px rgba(0,0,0,0.2);
    }
    .wrapper .option{
    background: #fff;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    /* justify-content: space-evenly; */
    margin: 20px;
    border-radius: 5px;
    cursor: pointer;
    padding: 10px;
    border: 2px solid lightgrey;
    transition: all 0.3s ease;
    }
    .wrapper .option .dot{
    height: 20px;
    width: 20px;
    min-width: 20px;
    background: #d9d9d9;
    border-radius: 50%;
    position: relative;
    margin-right: 20px;
    }
    .wrapper .option .dot::before{
    position: absolute;
    content: "";
    top: 4px;
    left: 4px;
    width: 12px;
    height: 12px;
    background: #0069d9;
    border-radius: 50%;
    opacity: 0;
    transform: scale(1.5);
    transition: all 0.3s ease;
    }
    input[type="radio"]{
    display: none;
    }
    #option-1:checked:checked ~ .option-1,
    #option-2:checked:checked ~ .option-2,
    #option-3:checked:checked ~ .option-3,
    #option-4:checked:checked ~ .option-4{
    border-color: #0069d9;
    background: #0069d9;
    }
    #option-1:checked:checked ~ .option-1 .dot,
    #option-2:checked:checked ~ .option-2 .dot,
    #option-3:checked:checked ~ .option-3 .dot,
    #option-4:checked:checked ~ .option-4 .dot{
    background: #fff;
    }
    #option-1:checked:checked ~ .option-1 .dot::before,
    #option-2:checked:checked ~ .option-2 .dot::before,
    #option-3:checked:checked ~ .option-3 .dot::before,
    #option-4:checked:checked ~ .option-4 .dot::before{
    opacity: 1;
    transform: scale(1);
    }
   
    #option-1:checked:checked ~ .option-1 span,
    #option-2:checked:checked ~ .option-2 span,
    #option-3:checked:checked ~ .option-3 span,
    #option-4:checked:checked ~ .option-4 span{
    color: #fff;
    }

    .ML__base {
        visibility: inherit;
        display: inline-block;
        position: relative;
        cursor: text;
        padding: 0;
        margin: 0;
        box-sizing: content-box;
        border: 0;
        outline: 0;
        vertical-align: baseline;
        font-weight: inherit;
        font-family: inherit;
        font-style: inherit;
        text-decoration: none;
        width: revert !important;
    }

    .ML__mathit {
    font-family: Arial, Helvetica, sans-serif;
    font-style: normal;
}
</style>

