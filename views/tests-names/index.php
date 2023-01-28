<?php

use app\models\Classes;
use app\models\Sciences;
use app\models\TestsNames;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\grid\GridView as GridGridView;

/** @var yii\web\View $this */
/** @var app\models\TestsNamesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Testlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-names-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Yangi test yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'label'=>'Sinf',
                'attribute' => 'classes_id',
                'value' => function ($data) {
                    return $data['c_name'];
                },
                'filter' => Classes::getList(),
            ],

            [
                'label'=>'Fanlar',
                'attribute' => 'sciences_id',
                'value' => function ($data) {
                    return $data['s_name'];
                },
                'filter' => Sciences::getList(),
            ],
            
            [
                'class' => ActionColumn::className(),
                'template' => '{view}{update} {delete}',
                'buttons'=>[
                    'view' => function ($url, $data) 
                    {
                        return \yii\helpers\Html::a(
                            'Kirish',
                            Url::to(['tests-names/create-questions', 'id' => $data["id"]]),
                            ['class' => 'btn btn-success']);
                    },
                    'update' => function ($url, $data) 
                    {
                        return \yii\helpers\Html::a(
                            'Tahrirlash',
                            Url::to(['tests-names/update', 'id' => $data["id"]]),
                            ['class' => 'btn btn-info']);
                    },
                    'delete' => function ($url, $data) 
                    {
                        return \yii\helpers\Html::a(
                            'O`chiqish',
                            Url::to(['tests-names/delete', 'id' => $data["id"]]),
                            ['class' => 'btn btn-warning', 'data-confirm' => 'Вы действительно хотите удалить?', 'data-method' => 'post']);
                    },
                  
                ]
            ],
        ],

    ]); ?>


</div>
