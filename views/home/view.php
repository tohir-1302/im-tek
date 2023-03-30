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
    <?= $true_answer * 100 / $tets_names->question_count ?>%
    </div>
    <div class="answer_false">
        Xato javob: <?= $tets_names->question_count - $true_answer ?>
    </div>
</div>

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
                        <td>   <?=  $item['question'] ?>  </td>
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

