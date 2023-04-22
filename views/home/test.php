<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$tests_count = count($result['test_count']);
?>
    <div class="time_" style="display: none;">
        <?= $result['time'] ?>
    </div>
    <div class="row"  onmousedown="return false" onselectstart="return false">
        <div class="col-lg-4" style="text-align: center;">
            <h3><?= $result['test_name'] ?></h3>
        </div>
        <div class="col-sm-1 end__time" style="text-align: right; margin-left: 120px;">
                <span class="hours">
                    00
                </span>
                :
                <span class="minut">
                    00
                </span>
                :
                <span class="secund">
                    00
                </span>
        </div>
        <div class="col-sm-4" style="text-align: center;">
            <?php
                $form = ActiveForm::begin([
                    'action' => ['home/end-test'],
                    'method'=> 'post',
                    'options' => [
                        // 'data-pjax' => 1
                    ]]); ?>
                <?= Html::hiddenInput('test_singup_id', $result['question']['test_sing_up_id']); ?>
                <?= Html::submitButton('Tugatish', ['class' =>"btn_1 end__test", 'data-confirm' => 'Testni haqiqatdan tugatishni xohlaysizmi?']) ?>
            <?php ActiveForm::end(); ?> 
        </div>
    </div>
</div>
<br>

<input type="hidden" id="test_answer_id" name="custId" value="<?= $result['question']['id'] ?>">
<div class="wrapper_"  onmousedown="return false" onselectstart="return false">
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
<?php Pjax::begin(); ?>

<div class="wrapper" onmousedown="return false" onselectstart="return false">
    <div class="question">
        <table>
            <tr>
                <td id="question_">
                    <div class="view__image">
                        <?php 
                        if ($result['question']['file_name'] != null){
                            $resp = json_decode($result['question']['file_name']);
                            foreach ($resp as $item_): 
                        ?>
                        <img id="myImg" src="<?=Yii::getAlias("@q_img")?>/question_file/<?= $item_ ?>" alt="">
                    <?php endforeach; } ?>
                    </div>
                    <div class="question_tetx">
                        <?= $result['question']['question'] ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
 <input type="radio" name="select" id="option-1" <?= $result['question']['answer_client'] == 1 ? 'checked' : '' ?> >
 <input type="radio" name="select" id="option-2" <?= $result['question']['answer_client'] == 2 ? 'checked' : '' ?>>
 <input type="radio" name="select" id="option-3" <?= $result['question']['answer_client'] == 3 ? 'checked' : '' ?>>
 <input type="radio" name="select" id="option-4" <?= $result['question']['answer_client'] == 4 ? 'checked' : '' ?>>

    <label for="option-1" class="option option-1">
        <div class="dot " ></div>
        <span> <?= $result['question']['option_A'] ?></span>
    </label>

    <label for="option-2" class="option option-2">
        <div class="dot"></div>
        <span> <?= $result['question']['option_B'] ?></span>
    </label>

    <label for="option-3" class="option option-3">
        <div class="dot"></div>
        <span> <?= $result['question']['option_C'] ?></span>
    </label>

    <label for="option-4" class="option option-4">
        <div class="dot"></div>
        <span> <?= $result['question']['option_D'] ?></span>
    </label>

    <div class="next__back__button">
    <?php if ($result['question']['number'] != 1) : ?>
            <div class="back__button">
                <?php $form = ActiveForm::begin([
                    'action' => ['home/test'],
                    'method'=> 'post',
                    'options' => [
                        // 'data-pjax' => 1
                    ]]); ?>
                    <?= Html::hiddenInput('test_names_id', $result["tets_names_id"]); ?>
                    <?= Html::hiddenInput('question_number', $result['question']['number'] - 1); ?>
                <?= Html::submitButton('<img src="https://img.icons8.com/stickers/70/null/circled-left.png"/>' , ['style' => 'background: none; border: none;']) ?>
                <?php ActiveForm::end(); ?>
            </div> 
        <?php endif; ?>
        <?php if ($result['question']['number'] != $tests_count) : ?>
            <div class="next__button">
                <?php $form = ActiveForm::begin([
                    'action' => ['home/test'],
                    'method'=> 'post',
                    'options' => [
                        // 'data-pjax' => 1
                    ]]); ?>
                    <?= Html::hiddenInput('test_names_id', $result["tets_names_id"]); ?>
                    <?= Html::hiddenInput('question_number', $result['question']['number'] + 1); ?>
                <?= Html::submitButton('<img src="https://img.icons8.com/stickers/70/null/circled-right.png"/>' , ['style' => 'background: none; border: none;']) ?>
                <?php ActiveForm::end(); ?>
            </div> 
        <?php endif; ?>
     
    </div>
</div>
<?php Pjax::end(); ?> 

<div class="test_singup_id" style="color: white; position: absolute; z-index: -500;">
    <?= $result['question']['test_sing_up_id'] ?>
</div>

<div id="myModal" class="modal">
  <span class="close__img">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
 
<?php
ob_start();
include "script.js";
$script = ob_get_clean();
$this->registerJs($script);
?>

<style>
    .img_question img{
        width: 70px;
        margin-right: 3px
    }
    .img_question{
        margin-right: 10px;
    }
    .question_all_data{
        display: flex;
    }
    #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: absolute; /* Stay in place */
    z-index: 101 !important; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
    }

    /* The Close Button */
    .close__img {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    }

    .close__img:hover,
    .close__img:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
    }
</style>

<style>
    .next__back__button{
        display: flex;
        justify-content: space-around;
        
    }
    
    .question_tetx{
        margin-left: 10px;
        justify-items: center;
        vertical-align: middle !important;
        
    }
    #question_{
        display: flex;
    }
    .view__image img{
        width: 300px;
    }

    .view__image{
        display: flex;
        justify-content: space-around;
    }

    /* .end__test{
        margin: -10px;
        margin-right: 50px;
    } */

    .end__time{
        display: flex;
        /* margin-right: 100px; */
        font-size: 20px;
        font-weight: 650;
        font-family: monospace;
        color: #A41704 ;
        height: 40px;
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

    .wrapper_{
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

    @media screen and (max-width:550px) {
    .time__test_name {
        display: block;
        justify-content: space-between;
    }
    .end__test{
        float: right;
        margin-top: -70px;
    }

    #question_ {
        display: block;  
    }
}
</style>

