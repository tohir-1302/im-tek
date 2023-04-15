<?php

use app\models\User;

    $user = Yii::$app->user->identity;
?>
<style>
    .answer_foiz{
        text-align: center;
        font-weight: 650;
        font-size: 30px;
    }
    .amswer__test__{
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    
    .answer_true{
        color: #0E5F00;
        font-weight: 650;
        font-size: 16px;
    }

    .answer_false{
        color: #903006;
        font-weight: 650;
        font-size: 16px;
    }
</style>
<div style="display: flex; justify-content: space-between;">
    <h3> <?= $tets_names->name?></h3>
    <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/index', 'type' => 'attendees']) ?>"><img src="https://img.icons8.com/nolan/54/circled-left-2.png"/></a>
</div>


<div class="amswer__test__">
    <div class="answer_true">
        To'g'ri javob:  <?= $true_answer ?>
    </div>
    <div class="answer_foiz">
    <?= pul2($true_answer * 100 / $tets_names->question_count, 2)?>%
    </div>
    <div class="answer_false">
        Xato javob: <?= $tets_names->question_count - $true_answer ?>
    </div>
</div>
    <?php if ($tets_names->end_date < date("Y-m-d H:i:s") || $user->role == User::Admin) : ?>
        <div class="white_card_body">
            <div class="QA_section">
                <div class="QA_table mb_30">
                    <table class="table lms_table_active ">
                        <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Savol</th>
                                <th scope="col">Siz bergan javob</th>
                                <th scope="col">To`g`ri javob</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; foreach ($allQuestions as $item) : ?>
                            <tr style=" <?= $item['answer_client'] != $item['answer_success'] ? 'background-color: #FFD2C7; !important' : 'background-color: #A3FFA3BB; !important'  ?>">
                                <th scope="row"> <?= $number ?></th>

                                <td>     
                                    <div class="question_all_data">
                                        <div class="img_question">
                                            <?php 
                                                if ($item['file_name'] != null){
                                                    $resp = json_decode($item['file_name']);
                                                    foreach ($resp as $item_): 
                                            ?>
                                                    <img id="myImg" src="<?=Yii::getAlias("@q_img")?>/question_file/<?= $item_ ?>" alt="">
                                            <?php endforeach; } ?>
                                        </div>
                                        <?= $item['question']  ?>
                                    </div>  
                                </td>
                                <td>  <?php 
                                    switch ($item['answer_client']) {
                                        case 0:
                                            echo "Belgilanmagan";
                                            break;
                                        case 1:
                                            echo $item['option_A'];
                                            break;
                                        case 2:
                                            echo $item['option_B'];
                                            break;
                                        case 3:
                                            echo $item['option_C'];
                                            break;
                                        case 4:
                                            echo $item['option_D'];
                                            break;
                                    }
                                ?>  </td>
                                
                                <td> <?php 
                                    switch ($item['answer_success']) {
                                        case 1:
                                            echo $item['option_A'];
                                            break;
                                        case 2:
                                            echo $item['option_B'];
                                            break;
                                        case 3:
                                            echo $item['option_C'];
                                            break;
                                        case 4:
                                            echo $item['option_D'];
                                            break;
                                    }
                                ?> </td>
                            </tr>
                            <?php $number++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close__img">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close__img")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>


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