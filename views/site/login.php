<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="<?=Yii::getAlias("@img")?>/signin-image.jpg" alt="sing up image"></figure>
                <?= Html::a('Yangi hisob ochish', ['site/signup'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="signin-form">
                <h4 class="form-title"><img src="<?=Yii::getAlias("@img")?>/logo.png" alt=""></h4>
                <?php $form = ActiveForm::begin(['id' => 'login-form', "class" => "register-form"]); ?>

                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'id'=>"your_name", 'class' => 'input_style', "placeholder" => "Foydalanuvchi nomi"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <!-- <label for="your_pass"><i class="zmdi zmdi-lock"></i></label> -->
                        <?= $form->field($model, 'password')->passwordInput(['id'=>"your_pass", 'class' => 'input_style', "placeholder" => "Parol"])->label(false) ?>
                    </div>
                    <div class="form-group form-button">
                            <?= Html::submitButton('Kirish', ['class' => 'form-submit', "id"=>"signin", 'name' => 'login-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
                
                <div class="social-login">
                    <span class="social-label">Biz bilan aloqa </span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
