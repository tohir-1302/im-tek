<?php

use app\models\Classes;
use app\models\Districts;
use app\models\Regions;
use app\models\Sciences;
use app\models\UsersFilter;
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
$roles = UsersFilter::getRole();
$status = UsersFilter::getStatus();
$this->title = 'Testlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-names-index">
    <br>
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
<div class="search__form" style="width: 100% !important;">
                <?php $form = ActiveForm::begin(['action' => ['users/all-users'], 'method'=> 'get', 'options' => ['data-pjax' => 1]]); ?>
                    <div class="row">
                            <div class="col-lg-4">
                                <?= $form->field($user_model, 'fio')->textInput(['maxlength' => true, 'class'=>"form_input_styles__", ]) ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($user_model, 'role')->widget(Select2::classname(), [
                                    'data' => $roles,
                                    'options' => ['class'=>"", 'prompt' => 'Все'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                            </div>
                            <div class="col-lg-2 " style="padding-top: 19px;">
                                <?= Html::submitButton('Izlash  |  <img src="' . Yii::getAlias("@img") .'/icon/icon_search.svg" alt="">', ['class' => 'btn_1']) ?>
                            </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
<hr>
<div class="white_card_body">
    <div class="QA_section">
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Ism, Familiya</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Satatus</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($all__users as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td><?=  $item['first_name']. " ". $item['last_name']   ?></td>
                        <td><?=  $item['username'] ?></td>
                        <td><?=  $item['password_hash'] ?></td>
                        <td><?=  $item['email'] ?></td>
                        <td><?=  $roles[$item['role']] ?></td>
                        <td><?=  $status[$item['status']] ?></td>
                        <td>  
                            <?=  \yii\helpers\Html::a(
                                '<i class="far fa-edit"></i>',
                                Url::to(['users/my-profile', 'user_id' => $item["id"]]),
                                ['class' => 'action_btn mr_10', 'style'=>'font-size: 15px']); 
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
<?php Pjax::end(); ?>