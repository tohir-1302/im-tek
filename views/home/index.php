<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use function PHPSTORM_META\type;

$styele_active = ' border-left: 8px solid green; border-right: 8px solid green; ';
$styele_passive = ' border-left: 8px solid black; border-right: 8px solid black; ';
?>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" style="text-align: center; font-weight: 650; font-size: 20px;">
            <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('danger')): ?>
        <div class="alert alert-danger alert-dismissible" style="text-align: center; font-weight: 650; font-size: 20px;">
            <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
            <?= Yii::$app->session->getFlash('danger') ?>
        </div>
    <?php endif; ?>


    <div class="tabs_wrap">
        <ul>
            <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/index', 'type' => 'active']) ?>" class="<?= $type == "active"  ? 'active_' : '' ?>" >Faol</a>
            <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/index', 'type' => 'registered']) ?>" class="<?= $type == "registered"  ? 'active_' : '' ?>" >Ro`yxatdan o`tilganlar</a>
            <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/index', 'type' => 'attendees']) ?>" class="<?= $type == "attendees"  ? 'active_' : '' ?>" >Qatnashilganlar</a>
        </ul>
  </div>
<br>

<div class="white_card_body">
    <div class="QA_section">
        <div class="QA_table mb_30">
            <table class="table lms_table_active ">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Sinf / Fan </th>
                        <th scope="col">Sana</th>
                        <th scope="col"><img src="https://img.icons8.com/stickers/26/null/info-squared.png"/></th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($tests as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td> 
                            <b>Sinf: </b> <?=  $item['classes_name'] ?> <br> 
                            <b>Fan: </b><?=  $item['sciences_name'] ?> <br>
                            <b>Test nomi: </b> <?= $item['name'] ?>
                        </td>
                        <td><?=  datetimeView($item['begin_date'])   ?> / <br> 
                        <?=  datetimeView($item['end_date'])   ?></td>
                        <td> <b>Davomiyligi:</b> <?=  $item['time_limit'] ?> <br> <b>Savollar soni:</b>  <?=   $item['question_count']   ?></td>
                        <td>
                            <?php if ($item['tests_status'] == null) { ?>
                                <?php $form = ActiveForm::begin([
                                                'action' => ['home/sign-up-test'],
                                                'method'=> 'post',
                                                'options' => [
                                                    'data-pjax' => 1
                                                ]]); ?>
                                                <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                            <?= Html::submitButton('Ro\'yxatdan o\'tish', ['class' => 'btn btn-primary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!',]) ?>
                                <?php ActiveForm::end(); ?>
                            <?php } ?>
                           
                            <?php if (in_array($item['tests_status'], [1])) { ?>

                                <?php $form = ActiveForm::begin([
                                                'action' => ['home/test'],
                                                'method'=> 'post',
                                                'options' => [
                                                    'data-pjax' => 1
                                                ]]); ?>
                                                <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                            <?= Html::submitButton('Boshlash', ['class' => 'btn btn-success']) ?>
                                            <?php ActiveForm::end(); ?>
                            <?php } ?>

                            <?php if (in_array($item['tests_status'], [2])) { ?>

                                <?php $form = ActiveForm::begin([
                                        'action' => ['home/test'],
                                        'method'=> 'post',
                                        'options' => [
                                            'data-pjax' => 1
                                        ]]); ?>
                                        <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                    <?= Html::submitButton('Ishtirok etilyapti ...', ['class' => 'btn btn-primary']) ?>
                                <?php ActiveForm::end(); ?>
                            <?php } ?>

                            <?php if ($item['tests_status'] == 3) { ?>
                                <?= \yii\helpers\Html::a('Ko\'rish',Url::to(['home/view', 'test_singup_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-secondary']); 
                                ?>
                            <?php } ?>
                            <?php if ($item['tests_status'] == 4) { ?>
                                <?= \yii\helpers\Html::a('Qatnashilmadi',Url::to(['#', ]),['class' => 'btn btn-warning', ]); ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $number++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

