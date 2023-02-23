<?php

use yii\helpers\Html;
use yii\helpers\Url;

$styele_active = ' border-left: 8px solid green; border-right: 8px solid green; ';
$styele_passive = ' border-left: 8px solid black; border-right: 8px solid black; ';
?>

<style>
table {
  border-collapse: collapse;
  overflow-x: scroll;
  width: 100%;
}

th{
  padding: 8px;
  text-align: left;
  border-bottom: 2px solid #ddd;
  vertical-align: middle !important;
}
table tr td {
  padding: 8px;
  text-align: left;
  border: 2px solid #ddd;
  font-family: monospace;
  color: #2A68A2;
  font-weight: 550;
  font-size: 18px;
}
 
table tbody tr {
    height: 100px !important;
    border-radius: 12px !important;
}
table tbody tr:hover td{
    background-color: #C7960466 ; 
    color: black !important;
    transition: .3s ease-in-out;
}

.top_text {
    background-color: #00155F;
    color: #ddd;
}
</style>

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
        <div class="icetab current-tab">Faol</div>
        <div class="icetab">Ro`yxatdan o`tilganlar</div>
    	<div class="icetab">Qatnashilganlar</div>
    </div>
    
    <div id="icetab-content">
            <div class="tabcontent tab-active">

                <table>
                    <thead>
                        <tr class="top_text">
                            <th>Sinf</th>
                            <th>Fan</th>
                            <th>Test nomi</th>
                            <th>Boshlanish vaqti</th>
                            <th>Tugash vaqti</th>
                            <th>Davomiyligi</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ( $tests as $item): if ($item['xolat']==='active') : ?>
                            <tr>
                            <td><?= $item['classes_name'] ?></td>
                            <td><?= $item['sciences_name'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?=datetimeView($item['begin_date']) ?></td>
                            <td><?= datetimeView($item['end_date']) ?></td>
                            <td><?= $item['time_limit'] ?></td>
                            <td>
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
                            </td>
                    
                        </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                   
                </table>

            </div> 
            <div class="tabcontent">
            <?php  foreach ( $tests as $item): if (in_array($item['tests_status'], [1, 2])) : ?>
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

            <div class="tabcontent">
                <?php $tr_number=1; foreach ( $tests as $item):  if (in_array($item['tests_status'], [4,3])) :  ?>
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
                <?php $tr_number++; endif; endforeach; ?>
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