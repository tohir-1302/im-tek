<?php

use app\models\Questions;
use Codeception\Util\Template;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PhpOffice\PhpSpreadsheet\Helper\Html as HelperHtml;
use Symfony\Component\Console\Question\Question;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\QuestionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $tests_names->name;
$this->params['breadcrumbs'][] = $this->title;
$answer = Questions::getAnswerQuestion();
?>
<div class="questions-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php Pjax::begin(); ?>

     <?php  echo $this->render('_form', [
        'model' => $model
     ])?>
  

<div class="white_card_body">
    <div class="QA_section">
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Savol</th>
                        <th scope="col">A variant</th>
                        <th scope="col">B variant</th>
                        <th scope="col">C variant</th>
                        <th scope="col">D variant</th>
                        <th scope="col">To`g`ri variant</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($dataProvider as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td>
                            <div class="question_all_data">
                                <div class="img_question">
                                    <?php 
                                        if ($item['file_name'] != null){
                                            $resp = json_decode($item['file_name']);
                                            foreach ($resp as $item_): 
                                    ?>
                                            <img src="<?=Yii::getAlias("@q_img")?>/question_file/<?= $item_ ?>" alt="">
                                    <?php endforeach; } ?>
                                </div>
                                <?= $item['question']  ?>
                            </div>
                        </td>
                        <td><?= $item['option_A']  ?></td>
                        <td><?= $item['option_B']  ?></td>
                        <td><?= $item['option_C']  ?></td>
                        <td><?= $item['option_D']  ?></td>
                        <td><?=  $answer[$item['answer_option']]  ?></td>
                        <td>
                            <!-- <a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i></a> -->
                            <?= \yii\helpers\Html::a(
                                '<i class="fas fa-trash"></i>',
                                Url::to(['questions/delete', 'id' => $item["id"]]),
                                ['class' => 'action_btn mr_10', 'style'=>'font-size: 15px', 'data-confirm' => 'Haqiqatdan o`chirmoqchimisiz?', 'data-method' => 'post']); ?>
                            
                            <?=  Html::a('<i class="far fa-edit"></i>',
                                Url::to(['questions/update', 'id'=> $item['id']]),
                                ['class' => 'action_btn mr_10', 'style'=>'font-size: 15px']); ?>
                        </td>
                    </tr>
                    <?php $number++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




    <?php Pjax::end(); ?>

</div>

<?php
    ob_start();
    include "mathlive.js";
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
</style>