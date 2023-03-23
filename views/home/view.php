<style>
    .answer_foiz{
        text-align: center;
        font-weight: 650;
        font-size: 30px;
    }


</style>
<div class="answer_foiz">
    40%
</div>
<div class="amswer__test__">
    <div class="answer_true">
        To'g'ri javob:  12
    </div>
    <div class="answer_false">
        Xato javob: 5
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
                        <td> <math-field readonly>  <?=  $item['question'] ?> </math-field> </td>
                        <td> <math-field readonly> <?php 
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
                        ?> </math-field> </td>
                        
                        <td><math-field readonly> <?php 
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
                        ?></math-field> </td>
                    </tr>
                    <?php $number++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

