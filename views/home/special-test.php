<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$styele_active = ' border-left: 8px solid green; border-right: 8px solid green; ';
$styele_passive = ' border-left: 8px solid black; border-right: 8px solid black; ';
$this->title = Yii::t('app', 'Imtihonlar');

?>
<?php Pjax::begin(); ?>


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
    <div class="row">
        <div class="col-lg-12 special_test_form">
            <div class="bloc____">
                <h3>Maxsus test</h3>
                <?php $form = ActiveForm::begin([
                        'action' => ['home/special-test'],
                        'method'=> 'post',
                        'options' => [
                            'data-pjax' => 1
                        ]]); ?>

                    <?= Html::hiddenInput('tests_names_id', $tests_names_id); ?>
                    <?= Html::passwordInput('password', $password); ?> <br>
                    <?= Html::submitButton('Kirish', ['class' => "special_test_submit"]) ?>

                <?php ActiveForm::end(); ?>
            </div>
           
        </div>
    </div>
  
<?php Pjax::end(); ?> 

<style>
    .bloc____{
        padding: 40px 42px;
        background-color: #FFFFFFDC;
        border-radius: 20px;
        box-shadow: 1px 1px 27px #9E9EA2

    }

    .white_card{
        padding: 0;
    }
    .special_test_form{
        text-align: center;
        padding: 10% 18%;
        background-image: url(/web/img/special_test.png);
        background-attachment: fixed;
        background-size: 50%;
        background-repeat: 3;
    }

    .special_test_form input[type=password]{
        border: 3px solid #00066F;
        padding: 10px 12px;
        border-radius: 20px;
        width: 100%;
        font-size: 14px;
        box-shadow: 0 4px 7px grey
    }

    .special_test_form input[type=password]:focus{
        border: 3px solid #025807;
        box-shadow: 0 4px 7px grey
    }

    .special_test_form h3{
        font-weight: 800;
        color: #0C0242;
        margin-bottom: 15px;
    }
        
    .special_test_submit{
        background-color: #0C0242;
        width: 100%;
        text-align: center0;
        color: white;
        font-weight: 800;
        border: none;
        padding: 10px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        margin-top: 20px;
    }
</style>