<?php

use app\models\Regions;
use kartik\grid\GridView as GridGridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RegionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Viloyatlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .fomrs_{
        display: flex;
        justify-content: space-between;
    }
</style>
<div class="regions-index">

<div class="fomrs_">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?=  $this->render('_form', ['model'=>$model]) ?>
    </p>
</div>
  


    <?php Pjax::begin(); ?>

    <?php /* echo $this->render('_form', ['model' => $model]); */ ?>

    <?= GridGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'class' => ActionColumn::className(),
                'template' => '{delete} {update}',
                'urlCreator' => function ($action, Regions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
