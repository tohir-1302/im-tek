<?php

use app\models\Classes;
use app\models\Sciences;
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

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="header_search_create">
        <p >
            <?= Html::a('Yangi test yaratish', ['create'], ['class' => 'btn_1']) ?>
        </p>
        <div class="search__form">
            <?php $form = ActiveForm::begin(['action' => ['index'], 'method'=> 'get','options' => ['data-pjax' => 1]]); ?>
                <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($searchModel, 'classes_id')->widget(Select2::classname(), [
                                'data' => Classes::getList(),
                                'options' => ['class'=>"", 'prompt' => 'Все'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($searchModel, 'sciences_id')->widget(Select2::className(), [
                                'data' => Sciences::getList(),
                                'options' => ['class'=>"" , 'prompt' => 'Все'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>

                        <div class="col-lg-1 " style="padding-top: 19px;">
                            <?= Html::submitButton('Izlash  |  <img src="' . Yii::getAlias("@img") .'/icon/icon_search.svg" alt="">', ['class' => 'btn_1']) ?>
                        </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
   
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


<div class="white_card_body">
    <div class="QA_section">
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Sinf</th>
                        <th scope="col">Fanlar</th>
                        <th scope="col">Savollan soni</th>
                        <th scope="col">Boshlanish Vaqti</th>
                        <th scope="col">Tugash Vaqti</th>
                        <th scope="col">Test davomiyligi</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($dataProvider as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td><?=  $item['c_name']   ?></td>
                        <td><?=  $item['s_name']   ?></td>
                        <td><?=  $item['question_count']   ?></td>
                        <td><?=  datetimeView($item['begin_date'])   ?></td>
                        <td><?=  datetimeView($item['end_date'])   ?></td>
                        <td><?=   $item['time_limit']   ?></td>
                        <td>
                            <!-- <a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i></a> -->
                            <?=  \yii\helpers\Html::a(
                                '<i class="fas fa-angle-double-right"></i>',
                                Url::to(['questions/index', 'id' => $item["id"]]),
                                ['class' => 'action_btn mr_10', 'style'=>'font-size: 15px']); 
                            ?>
                            
                            <?=  \yii\helpers\Html::a(
                                '<i class="far fa-edit"></i>',
                                Url::to(['tests-names/update', 'id' => $item["id"]]),
                                ['class' => 'action_btn mr_10', 'style'=>'font-size: 15px']); 
                            ?>

                            <?= \yii\helpers\Html::a(
                                '<i class="fas fa-trash"></i>',
                                Url::to(['tests-names/delete', 'id' => $item["id"]]),
                                ['class' => 'action_btn mr_10', 'style'=>'font-size: 15px', 'data-confirm' => 'Haqiqatdan o`chirmoqchimisiz?', 'data-method' => 'post']);
                            ?>
                            <?php   if ($item['status'] == 1) {
                                        echo \yii\helpers\Html::a(
                                            'Clientga chiqarish',
                                            Url::to(['tests-names/status', 'id' => $item["id"]]),
                                            ['class' => 'btn btn-primary', 'data-confirm' => 'Client qismiga chiqarilyapti !!! Orqaga qaytarish Admin tomonidan amalga oshiriladi!', 'data-method' => 'post']);
                                    }else{
                                       echo "<span class='btn btn-success'>Clientga chiqarildi !</span>";
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
