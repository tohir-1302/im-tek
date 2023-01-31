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

    <?= GridView::widget([
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
    ]); ?>

    <?php Pjax::end(); ?>

</div>