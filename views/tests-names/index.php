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
                    return $data['classes_id'];
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
                'template' => '{update}',
                'buttons'=>[
                    'update' => function ($url, $data) {
                        return \yii\helpers\Html::a(
                            'salom',
                            \Yii::$app->getUrlManager()->createUrl(
                                array('tests-names/delete', 'id' => $data["id"])
                            )
                        );
                    },
                ]
            ],
        ],

    ]); ?>


</div>
