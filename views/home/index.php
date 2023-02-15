<?php

use yii\helpers\Html;
use yii\helpers\Url;

$styele_active = ' border-left: 8px solid green; border-right: 8px solid green; ';
$styele_passive = ' border-left: 8px solid black; border-right: 8px solid black; ';
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
         <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

    <div id="icetab-container">
    	<div class="icetab current-tab">Barchasi</div>
        <div class="icetab">Faol</div>
        <div class="icetab">Ro`yxatdan o`tilganlar</div>       
    </div>
    
    <div id="icetab-content">
       
            <div class="tabcontent tab-active">
                <?php $tr_number=1; foreach ( $tests as $item): ?>
                    <div class="content__data" style="<?=$item['xolat']==='active' ? $styele_active : $styele_passive ?>">
                        <div class="data__left">
                            <!-- <div class="tr_number"><?php /* $tr_number*/ ?></div> -->
                            <div class="classes__name">Sinf: <?= $item['classes_name'] ?></div>
                            <div class="sciences__name">Fan: <?= $item['sciences_name'] ?></div>
                        </div>
                        <div class="data__center">
                            <div class="tests__name"><?= $item['name'] ?></div>
                        </div>
                        <div class="data__right">
                            <div class="begin__date"> <b>Boshlash vaqti: </b> <i> <?= datetimeView($item['begin_date']) ?></i></div>
                            <div class="end__date"> <b>Tugash vaqti: </b> <i><?= datetimeView($item['end_date']) ?></i></div>
                            <div class="end__date"> <b>Davomiyligi: </b> <i><?= $item['time_limit'] ?></i></div>
                        </div>
                        <div class="buttons__">
                            <?php if ($item['tests_status'] == null) { ?>
                                <?= \yii\helpers\Html::a('Ro\'yxatdan o\'tish',Url::to(['home/sign-up-test', 'test_names_id' => $item["id"]]),
                                    ['class' => 'btn btn-primary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>

                            <?php if (in_array($item['tests_status'], [1, 2])) { ?>
                                <?= \yii\helpers\Html::a('Boshlash',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-success', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>

                            <?php if ($item['tests_status'] == 3) { ?>
                                <?= \yii\helpers\Html::a('Ko\'rish',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-secondary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>

                            <?php if ($item['tests_status'] == 4) { ?>
                                <?= \yii\helpers\Html::a('Qatnashilmadi',Url::to(['#', ]),['class' => 'btn btn-warning', ]); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php $tr_number++; endforeach; ?>
            </div> 
            <div class="tabcontent">
                <?php  foreach ( $tests as $item): if ($item['xolat']==='active') : ?>
                    <div class="content__data" style="<?=$item['xolat']==='active' ? $styele_active : $styele_passive ?>">
                        <div class="data__left">
                            <!-- <div class="tr_number"><?php /* $tr_number*/ ?></div> -->
                            <div class="classes__name">Sinf: <?= $item['classes_name'] ?></div>
                            <div class="sciences__name">Fan: <?= $item['sciences_name'] ?></div>
                        </div>
                        <div class="data__center">
                            <div class="tests__name"><?= $item['name'] ?></div>
                        </div>
                        <div class="data__right">
                            <div class="begin__date"> <b>Boshlash vaqti: </b> <i> <?= datetimeView($item['begin_date']) ?></i></div>
                            <div class="end__date"> <b>Tugash vaqti: </b> <i><?= datetimeView($item['end_date']) ?></i></div>
                            <div class="end__date"> <b>Davomiyligi: </b> <i><?= $item['time_limit'] ?></i></div>
                        </div>
                        <div class="buttons__">
                            <?php if ($item['tests_status'] == null) { ?>
                                <?= \yii\helpers\Html::a('Ro\'yxatdan o\'tish',Url::to(['home/sign-up-test', 'test_names_id' => $item["id"]]),
                                    ['class' => 'btn btn-primary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>

                            <?php if (in_array($item['tests_status'], [1, 2])) { ?>
                                <?= \yii\helpers\Html::a('Boshlash',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-success', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>

                            <?php if ($item['tests_status'] == 3) { ?>
                                <?= \yii\helpers\Html::a('Ko\'rish',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-secondary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div> 
            <div class="tabcontent">
            <?php  foreach ( $tests as $item): if (in_array($item['tests_status'], [1, 2,3])) : ?>
                    <div class="content__data" style="<?=$item['xolat']==='active' ? $styele_active : $styele_passive ?>">
                        <div class="data__left">
                            <!-- <div class="tr_number"><?php /* $tr_number*/ ?></div> -->
                            <div class="classes__name">Sinf: <?= $item['classes_name'] ?></div>
                            <div class="sciences__name">Fan: <?= $item['sciences_name'] ?></div>
                        </div>
                        <div class="data__center">
                            <div class="tests__name"><?= $item['name'] ?></div>
                        </div>
                        <div class="data__right">
                            <div class="begin__date"> <b>Boshlash vaqti: </b> <i> <?= datetimeView($item['begin_date']) ?></i></div>
                            <div class="end__date"> <b>Tugash vaqti: </b> <i><?= datetimeView($item['end_date']) ?></i></div>
                            <div class="end__date"> <b>Davomiyligi: </b> <i><?= $item['time_limit'] ?></i></div>
                        </div>
                        <div class="buttons__">
                            <?php if (in_array($item['tests_status'], [1, 2])) { ?>
                                <?= \yii\helpers\Html::a('Boshlash',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-success', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>

                            <?php if ($item['tests_status'] == 3) { ?>
                                <?= \yii\helpers\Html::a('Ko\'rish',Url::to(['home/sign-up-test', 'sing_up_id' => $item["sing_up_id"]]),
                                    ['class' => 'btn btn-secondary', 'data-confirm' => 'Haqiqatdan ro\'yxatdan o\'tmoqchimisiz? Agar ro`yxatdan o`tsangiz hisobingizdan to`lov yechib olinadi!!!', 'data-method' => 'post']); 
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div> 
    </div> 





<script>
var tabs = document.getElementById('icetab-container').children;
var tabcontents = document.getElementById('icetab-content').children;

var myFunction = function() {
	var tabchange = this.mynum;
	for(var int=0;int<tabcontents.length;int++){
		tabcontents[int].className = ' tabcontent';
		tabs[int].className = ' icetab';
	}
	tabcontents[tabchange].classList.add('tab-active');
	this.classList.add('current-tab');
}	


for(var index=0;index<tabs.length;index++){
	tabs[index].mynum=index;
	tabs[index].addEventListener('click', myFunction, false);
}
</script>