<?php

use app\models\Districts;
use app\models\Regions;
use kartik\grid\GridView as GridGridView;
use kartik\grid\GridViewAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\grid\GridView as YiiGridGridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DistrictsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tumanlar');
$this->params['breadcrumbs'][] = $this->title;
$regions = Regions::getList();
?>
<div class="districts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?php  echo $this->render('_form', ['model' => $model]);  ?>

    <?= YiiGridGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            // 'regions_id',
            [
                'label' => 'Viloyat',
                'attribute' => 'regions_id',
                'value' => function($data) use ($regions){
                    return $regions[$data['regions_id']];
                },
                'filter' => $regions,
                // 'filterType' => GridViewAsset::FILTER_SELECT2,
              
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{delete} {update}',
                'urlCreator' => function ($action, Districts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>
