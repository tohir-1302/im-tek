<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$styele_active = ' border-left: 8px solid green; border-right: 8px solid green; ';
$styele_passive = ' border-left: 8px solid black; border-right: 8px solid black; ';
$this->title = Yii::t('app', 'Imtihonlar');

?>

<!-- MDB -->
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
                        <th scope="col" class="mobile_registr">#</th>
                        <th scope="col">Sinf / Fan </th>
                        <th scope="col">Sana</th>
                        <th scope="col"><img src="https://img.icons8.com/stickers/26/null/info-squared.png"/></th>
                        <th scope="col" class="mobile__registr">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($tests as $item) : ?>
                    <tr>
                        <th scope="row"> <?= $number ?></th>
                        <td class="mobile_registr">
                            <?php if ($item['tests_status'] == null) { ?>
                            
                                <?php 
                                if ($item['has_special_test'] == 1) {  ?>
                                    <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/special-test', 'tests_names_id'=> $item["id"]]) ?>" class="btn btn-primary" >Ro'yxatdan o'tish</a>
                                <?php  } else { ?>
                                <?php 
                                    $form = ActiveForm::begin([
                                                'action' => ['home/sign-up-test'],
                                                'method'=> 'post',
                                                'options' => [
                                                    'data-pjax' => 1
                                                ]]); ?>
                                                <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                            <?= Html::submitButton('Ro\'yxatdan o\'tish', ['class' => 'btn btn-primary']) ?>
                                <?php ActiveForm::end(); } ?>
                            <?php } ?>
                           
                            <?php if (in_array($item['tests_status'], [1])) { ?>
                                <?php if ($item['begin_date'] <= date("Y-m-d H:i:s") ) { ?>
                                    <?php $form = ActiveForm::begin([
                                                    'action' => ['home/test'],
                                                    'method'=> 'post',
                                                    'options' => [
                                                        'data-pjax' => 1
                                                    ]]); ?>
                                        <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                        <?= Html::submitButton('Boshlash', ['class' => 'btn btn-success']) ?>
                                    <?php ActiveForm::end(); ?>
                                <?php } else { ?>
                                    <?= \yii\helpers\Html::a('Test hali boshlanmadi!',Url::to(['#', ]),['class' => 'btn btn-info', ]); ?>
                                <?php } ?>
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
                                <?php if ($item['sertificat_status'] == 2 && ($item['sertifikat_foiz'] <= ($item['sing_up_answer'] / $item['sing_up_question_count'] *100))) { ?>
                                    <?= \yii\helpers\Html::a('<img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-certificate-online-education-flaticons-lineal-color-flat-icons-4.png"/>',Url::to(['site/sertificate', 'test_singup_id' => $item["sing_up_id"]]),
                                        ['class' => 'sertificate', 'target' => '_blank']); 
                                ?>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($item['tests_status'] == 4) { ?>
                                <?= \yii\helpers\Html::a('Qatnashilmadi',Url::to(['#', ]),['class' => 'btn btn-warning', ]); ?>
                            <?php } ?>
                        </td>
                        <td> 
                            <b>Sinf: </b> <?=  $item['classes_name'] ?> <br> 
                            <b>Fan: </b><?=  $item['sciences_name'] ?> <br>
                            <b>Test nomi: </b> <?= $item['name'] ?>
                        </td>
                        <td><?=  datetimeView($item['begin_date'])   ?> / <br> 
                        <?=  datetimeView($item['end_date'])   ?></td>
                        <td>
                             <b>Davomiyligi:</b> <?=  $item['time_limit'] ?> <br> 
                            <b>Savollar soni:</b>  <?=   $item['question_count']  ?>
                            <div class="maxsus_test" title="Maxsus testga maxsus parol orqali kiriladi!"><?= $item['has_special_test'] == 1 ? "Maxsus test" : "" ?></div>
                        </td>
                        <td class="mobile__registr">
                        <?php if ($item['tests_status'] == null) { ?>
                            <?php 
                                if ($item['has_special_test'] == 1) {  ?>
                                    <a href="<?= Yii::$app->getUrlManager()->createUrl(['home/special-test', 'tests_names_id'=> $item["id"]]) ?>" class="btn btn-primary" >Ro'yxatdan o'tish</a>
                                <?php  } else { ?>
                            <?php 
                                $form = ActiveForm::begin([
                                            'action' => ['home/sign-up-test'],
                                            'method'=> 'post',
                                            'options' => [
                                                'data-pjax' => 1
                                            ]]); ?>
                                            <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                        <?= Html::submitButton('Ro\'yxatdan o\'tish', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); } ?>
                        <?php } ?>
                           
                            <?php if (in_array($item['tests_status'], [1])) { ?>
                                <?php if ($item['begin_date'] <= date("Y-m-d H:i:s") ) { ?>
                                    <?php $form = ActiveForm::begin([
                                                    'action' => ['home/test'],
                                                    'method'=> 'post',
                                                    'options' => [
                                                        'data-pjax' => 1
                                                    ]]); ?>
                                        <?= Html::hiddenInput('test_names_id', $item["id"]); ?>
                                        <?= Html::submitButton('Boshlash', ['class' => 'btn btn-success']) ?>
                                    <?php ActiveForm::end(); ?>
                                <?php } else { ?>
                                    <?= \yii\helpers\Html::a('Test hali boshlanmadi!',Url::to(['#', ]),['class' => 'btn btn-info', ]); ?>
                                <?php } ?>
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
                                <?php if ($item['sertificat_status'] == 2 && ($item['sertifikat_foiz'] <= ($item['sing_up_answer'] / $item['sing_up_question_count'] *100))) { ?>
                                    <?= \yii\helpers\Html::a('<img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-certificate-online-education-flaticons-lineal-color-flat-icons-4.png"/>',Url::to(['site/sertificate', 'test_singup_id' => $item["sing_up_id"]]),
                                        ['class' => 'sertificate', 'target' => '_blank']); 
                                    ?>
                                <?php } ?>
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

<style>
    .sertificate img{
        width: 55px;
        margin-top: 10px;
        margin-left: 10px;
    }

    .maxsus_test{
        font-weight: 900;
        color: red;
    }
    .mobile_registr{
        display: none;
    }

@media only screen and (max-width: 600px) {
    .mobile_registr{
        display: table-cell;
    }
    .mobile__registr{
        display: none;
    }
  }
</style>

<script> 
    const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const openModalBtn = document.querySelector(".btn-open");
const closeModalBtn = document.querySelector(".btn-close");

// close modal function
const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

// close the modal when the close button and overlay is clicked
closeModalBtn.addEventListener("click", closeModal);
overlay.addEventListener("click", closeModal);

// close modal when the Esc key is pressed
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && !modal.classList.contains("hidden")) {
    closeModal();
  }
});

// open modal function
const openModal = function () {
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};
// open modal event
openModalBtn.addEventListener("click", openModal);

$(document).ready(function(){	
	$("#contactForm").submit(function(event){
		submitForm();
		return false;
	});
});


function submitForm(){
	 $.ajax({
		type: "POST",
		url: "saveContact.php",
		cache:false,
		data: $('form#contactForm').serialize(),
		success: function(response){
			$("#contact").html(response)
			$("#contact-modal").modal('hide');
		},
		error: function(){
			alert("Error");
		}
	});
}
</script>
