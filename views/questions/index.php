<?php

use app\models\Questions;
use Codeception\Util\Template;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PhpOffice\PhpSpreadsheet\Helper\Html as HelperHtml;
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
?>
<div class="questions-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php Pjax::begin(); ?>

    <div class="form_create">
        <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-lg-12 blox_create">
                    <?= $form->field($model, 'question')->textarea(['rows' => 1]) ?>
                    <math-field id ="question_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create ">
                    <?= $form->field($model, 'option_A')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_a_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'option_B')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_b_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'option_C')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_c_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'option_D')->textarea(['rows' => 1]) ?>
                    <math-field id ="option_d_math" virtual-keyboard-mode="manual"  class="form_input_styles__">
                    </math-field>
                </div>
                <div class="col-sm-2 blox_create">
                    <?= $form->field($model, 'answer_option')->widget(Select2::classname(), [
                                                'data' => Questions::getAnswerQuestion(),
                                                'options' => ['placeholder' => 'Выберите', 'class'=>"form_input_styles__"],
                                                'pluginOptions' => [
                                                    'allowClear' => false
                                                ],
                                                ]); ?>
                </div>
                <div class="col-sm-2">
                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>

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
                // 'attribute' => 'sciences_id',
                'value' => function ($data) {
                    return $data['option_B'];
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url, $data){
                        return Html::a('O\'chirish',
                        Url::to(['questions/delete', 'id'=> $data['id']]),
                        ['class' => 'btn btn-warning', 'data-confirm' => 'Haqiqatdan o`chirmoqchimisiz?', 'data-method' => 'post']);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>