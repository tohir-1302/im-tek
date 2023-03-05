<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use function PHPSTORM_META\type;

$styele_active = ' border-left: 8px solid green; border-right: 8px solid green; ';
$styele_passive = ' border-left: 8px solid black; border-right: 8px solid black; ';
?>

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
                        <th scope="col">Sinf</th>
                        <th scope="col">Fan</th>
                        <th scope="col">Test nomi</th>
                        <th scope="col">Boshlanish Vaqti</th>
                        <th scope="col">Tugash Vaqti</th>
                        <th scope="col">Test davomiyligi</th>
                        <th scope="col">Savollar soni</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($tests as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td><?=  $item['classes_name']   ?></td>
                        <td><?=  $item['sciences_name']   ?></td>
                        <td><?=  $item['name']   ?></td>
                        <td><?=  datetimeView($item['begin_date'])   ?></td>
                        <td><?=  datetimeView($item['end_date'])   ?></td>
                        <td><?=   $item['time_limit']   ?></td>
                        <td><?=   $item['question_count']   ?></td>
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
                                <?= \yii\helpers\Html::a('Ko\'rish',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-secondary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
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

