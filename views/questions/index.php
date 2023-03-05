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
                        <td><?= " <math-field readonly> ". $item['question']  . "</math-field>" ?></td>
                        <td><?= " <math-field readonly> ". $item['option_A']  . "</math-field>" ?></td>
                        <td><?= " <math-field readonly> ". $item['option_B']  . "</math-field>" ?></td>
                        <td><?= " <math-field readonly> ". $item['option_C']  . "</math-field>" ?></td>
                        <td><?= " <math-field readonly> ". $item['option_D']  . "</math-field>" ?></td>
                        <td><?= " <math-field readonly> ".  $answer[$item['answer_option']]  . "</math-field>" ?></td>
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



    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'Savol',
                'format'=>'raw',
                'attribute' => 'question',
                'value' => function ($data) {
                    return " <math-field readonly> ". $data['question']  . "</math-field>";
                },
            ],
            [
                'label'=>'A variant',
                'format'=>'raw',
                // 'attribute' => 'sciences_id',
                'value' => function ($data) {
                    return " <math-field readonly> ". $data['option_A'] . "</math-field>";
                },
            ],
            [
                'label'=>'B variant',
                'format'=>'raw',
                // 'attribute' => 'sciences_id',
                'value' => function ($data) {
                    return " <math-field readonly> ". $data['option_B'] . "</math-field>";
                },
            ],
            [
                'label'=>'C variant',
                'format'=>'raw',
                // 'attribute' => 'sciences_id',
                'value' => function ($data) {
                    return " <math-field readonly> ". $data['option_C'] . "</math-field>";
                },
            ],
            [
                'label'=>'D variant',
                'format'=>'raw',
                // 'attribute' => 'sciences_id',
                'value' => function ($data) {
                    return " <math-field readonly> ". $data['option_D'] . "</math-field>";
                },
            ],
            [
                'label'=>'To`g`ri variant',
                'format'=>'raw',
                // 'attribute' => 'sciences_id',
                'value' => function ($data) use ($answer){
                    return " <math-field readonly> ". $answer[$data['answer_option']] . "</math-field>";
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update}{delete}',
                'buttons' => [
                    'delete' => function($url, $data){
                        return Html::a('O\'chirish',
                        Url::to(['questions/delete', 'id'=> $data['id']]),
                        ['class' => 'btn btn-warning', 'data-confirm' => 'Haqiqatdan o`chirmoqchimisiz?', 'data-method' => 'post']);
                    },
                    'update' => function($url, $data){
                        return Html::a('Tahrirlash',
                        Url::to(['questions/update', 'id'=> $data['id']]),
                        ['class' => 'btn btn-success']);
                    }
                ]
            ],
        ],
    ]); */ ?>

    <?php Pjax::end(); ?>

</div>