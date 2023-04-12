<?php

use app\models\Classes;
use app\models\Districts;
use app\models\Regions;
use app\models\Sciences;
use kartik\export\ExportMenu;
use kartik\select2\Select2;
use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

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
<?php Pjax::begin(); ?>
<div class="row">
        <div class="col-lg-6">
            <?= 
                ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'label' => "Hudud",
                            'value'=>function($data){
                                return $data['regions_name'];
                            },
                        ],

                        [
                            'label' => "Tuman(shahar)",
                            'value'=>function($data){
                                return $data['districts_name'];
                            },
                        ],

                        [
                            'label' => "Maktab",
                            'value'=>function($data){
                                return $data['schools'];
                            },
                        ],

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
                ])
            ?>
        </div>

        <div class="col-lg-6">
            <div class="search__form" style="width: 100% !important;">
                <?php $form = ActiveForm::begin(['action' => ['tests-names/test-users'], 'method'=> 'get', 'options' => ['data-pjax' => 1]]); ?>
                    <div class="row">
                            <div class="col-lg-3">
                                <?= $form->field($user_model, 'regions_id')->widget(Select2::classname(), [
                                    'data' => Regions::getList(),
                                    'options' => ['class'=>"", 'prompt' => 'Все'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                            </div>

                            <div class="col-lg-3">
                                <?= $form->field($user_model, 'districts_id')->widget(Select2::className(), [
                                    'data' => Districts::getListAll(),
                                    'options' => ['class'=>"" , 'prompt' => 'Все'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                            </div>

                            <div class="col-lg-4">
                                <?= $form->field($user_model, 'schools')->textInput(['maxlength' => true, 'class'=>"form_input_styles__", ]) ?>
                                <?= $form->field($user_model, 'tests_names_id')->hiddenInput(['maxlength' => true, 'value' => $tests_names_id, 'class'=>"form_input_styles__", ])->label(false) ?>
                            </div>
                            <div class="col-lg-2 " style="padding-top: 19px;">
                                <?= Html::submitButton('Izlash  |  <img src="' . Yii::getAlias("@img") .'/icon/icon_search.svg" alt="">', ['class' => 'btn_1']) ?>
                            </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
</div>   
    

   

<hr>
<div class="white_card_body">
    <div class="QA_section">
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Hudud</th>
                        <th scope="col">Tuman(shahar)</th>
                        <th scope="col">Maktab</th>
                        <th scope="col">Ism, Familiya</th>
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
                        <td><?=  $item['regions_name']   ?></td>
                        <td><?=  $item['districts_name']   ?></td>
                        <td><?=  $item['schools']   ?></td>
                        <td><?=  $item['fio']   ?></td>
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
                        <td >
                            <div class="div" style="display: flex;">
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
                                        echo \yii\helpers\Html::a('<img src="https://img.icons8.com/color/25/null/undo.png"/>',Url::to(['tests-names/reset-test', 'test_singup_id' => $item["id"], 'tests_names_id' => $tets_names->id]),['class' => 'btn btn-secondary', 'style'=>'margin-left:15px']);
                                        break;

                                    case '4':
                                        echo \yii\helpers\Html::a('Qatnashilmadi',null,['class' => 'btn btn-warning']);
                                        break;
                                }
                            ?>
                            </div>
                           
                        </td>
                    </tr>
                    <?php $number++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<?php Pjax::end(); ?>


<?php
// javascriptni sahifaga qo'shish 
ob_start(); ?>

    $(document).ready(function() {
        $("#usersfilter-regions_id").change(function(e){    
            var regions_id = $("#usersfilter-regions_id").val();
            changeClient(regions_id);            
        });


        function changeClient(regions_id){
        $.ajax({
            url: "<?=url(['districts/chosen-type'])?>",
            method: "POST",
            data:{regions_id : regions_id},
            dataType: "json",            
            beforeSend: function(){                        
                $('#usersfilter-districts_id').empty();
                $('#usersfilter-districts_id').append('<option value="">Выберите</option>');
                // clientni tanlay olmaydigan qilib turamiz
                $( "#usersfilter-districts_id" ).prop( "disabled", true );
            },
                 
            success: function(data){
                // console.log(data);                                    
                $.each(data,function(i){
                    $('#usersfilter-districts_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');                
                });
                $( "#usersfilter-districts_id" ).prop( "disabled", false );
                           
            },

            error: function(){
                alert('Error - Qayta takrorlang!' + regions_id);
            }
        });
      }

    });
 
<?php $script = ob_get_clean();

$this->registerJs($script);

?>