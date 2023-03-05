<?php

use app\models\Classes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ClassesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Classes';
$this->params['breadcrumbs'][] = $this->title;
// prd($dataProvider);
$number = 1;
?>




<div class="white_card_body">
    <div class="QA_section">
        <div class="white_box_tittle list_header">
            <h4>Sinflar</h4>
            <div class="box_right">
                <?php  echo $this->render('_form', ['model' => $model]); ?>
            </div>
        </div>
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">T/r</th>
                        <th scope="col">Sinf</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataProvider as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td><?= $item['name'] . " - sinf " ?></td>
                        <td>
                            <!-- <a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i></a> -->
                            <?= \yii\helpers\Html::a(
                                '<i class="fas fa-trash"></i>',
                                Url::to(['classes/delete', 'id' => $item["id"]]),
                                ['class' => 'action_btn mr_10', 'data-confirm' => 'Haqiqatdan o`chirmoqchimisiz?', 'data-method' => 'post']); ?>
                        </td>
                    </tr>
                    <?php $number++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>






<!-- <div class="classes-index"> -->
    <?php /* Pjax::begin(); ?>
    <?php  echo $this->render('_form', ['model' => $model]); */?>

    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'urlCreator' => function ($action, Classes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); */ ?>

<!-- </div> -->
