<?php

use app\models\Classes;
use app\models\Sciences;
use kartik\export\ExportMenu;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestsNamesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Testlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-names-index">
    <br>
    <h1> <span style="color: blue;"><?= $tets_names->name ?></span>  testida qatnashganlar</h1>
    <br>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('danger')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= Yii::$app->session->getFlash('danger') ?>
        </div>
    <?php endif; ?>

<?= 
    ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'label' => "Ism, Familiya",
                'value'=>function($data){
                    return $data['fio'];
                },
            ],

            [
                'label' => "Ro`yxatdan o`tgan vaqti",
                'value'=>function($data){
                    return $data['create_date'];
                },
            ],

            [
                'label' => "Test boshlangan vaqt",
                'value'=>function($data){
                    return $data['start_date'];
                },
            ],

            [
                'label' => "Tugagan vaqt",
                'value'=>function($data){
                    return $data['end_test_date'];
                },
            ],

            [
                'label' => "Foiz: ",
                'value'=>function($data) use ($tets_names){
                    return  pul2($data['answer_success'] / $tets_names->question_count * 100, 1);
                },
            ],

            [
                'label' => "To`g`ri javoblar",
                'value'=>function($data) use ($tets_names){
                    return $data['answer_success'];
                },
            ],
            [
                'label' => "Xato javoblar",
                'value'=>function($data) use ($tets_names){
                    return $tets_names->question_count - $data['answer_success'] ;
                },
            ],

        ],
        
        'dropdownOptions' => [
            'label' => 'Yuklab olish',
            'class' => 'btn btn-outline-secondary btn-default'
        ]
    ]) . "<hr>\n"
?>

<div class="white_card_body">
    <div class="QA_section">
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Ism, Familiya</th>
                        <th scope="col">Ro`yxatdan o`tgan vaqti</th>
                        <th scope="col">Test boshlangan vaqt</th>
                        <th scope="col">Tugagan vaqt</th>
                        <th scope="col">Natija</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($result as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td><?=  $item['fio']   ?></td>
                        <td><?=  isset($item['create_date']) ? datetimeView($item['create_date']): "" ?></td>
                        <td><?=  isset($item['start_date']) ? datetimeView($item['start_date']): "" ?></td>
                        <td><?=  isset($item['end_test_date']) ? datetimeView($item['end_test_date']): "" ?></td>
                        <td>
                            <?php if($item['tests_status'] == 3) { ?>
                                <b>Foiz: </b><?= pul2($item['answer_success'] / $tets_names->question_count * 100, 2)  ?> % <br>
                                <b>To`g`ri javoblar: </b><?= $item['answer_success']  ?> <br>
                                <b>Xato javoblar: </b><?= $tets_names->question_count - $item['answer_success']  ?> <br>
                            <?php } else { ?>
                                Natijalar yo`q
                            <?php } ?>
                        </td>
                        <td>
                            <?php 
                                switch ($item['tests_status']) {
                                    case '1':
                                        echo \yii\helpers\Html::a('Boshlash',null,['class' => 'btn btn-success']);
                                        break;

                                    case '2':
                                        echo \yii\helpers\Html::a('Ishtirok etilyapti ...',null,['class' => 'btn btn-primary']);
                                        break;

                                    case '3':
                                        echo \yii\helpers\Html::a('Ko\'rish',Url::to(['home/view', 'test_singup_id' => $item["id"]]),['class' => 'btn btn-secondary']);
                                        echo \yii\helpers\Html::a('Qayta topshirish',Url::to(['tests-names/reset-test', 'test_singup_id' => $item["id"], 'tests_names_id' => $tets_names->id]),['class' => 'btn btn-primary', 'style'=>'margin-left:15px']);
                                        break;

                                    case '4':
                                        echo \yii\helpers\Html::a('Qatnashilmadi',null,['class' => 'btn btn-warning']);
                                        break;
                            }
                            ?>
                        </td>
                    </tr>
                    <?php $number++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
