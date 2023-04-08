<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use kartik\form\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="sign-in" style="margin-top: 7%;">
    <div class="container">
        <div class="signin-content">
            <div class="about__us">
                <img src="https://img.icons8.com/stickers/70/null/info.png"/>
            </div>
            <div class="signin-image">
                <figure><img src="<?=Yii::getAlias("@img")?>/signin-image.jpg" alt="sing up image"></figure>
                <?= Html::a('Yangi hisob ochish', ['site/signup'], ['class' => 'btn btn-success', 'style' => 'width: 100%']) ?>
            </div>
            <div class="signin-form">
                <h4 class="form-title"><img src="<?=Yii::getAlias("@img")?>/logo.png" alt=""></h4>
                <?php $form = ActiveForm::begin(['id' => 'login-form', "class" => "register-form"]); ?>

                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'id'=>"your_name", 'class' => 'input_style', "placeholder" => "Foydalanuvchi nomi"])->label(false) ?>
                    </div>
                    <div class="form-group" style="display: flex;">
                        <!-- <label for="your_pass"><i class="zmdi zmdi-lock"></i></label> -->
                        <?= $form->field($model, 'password')->passwordInput(['id'=>"password", 'class' => 'input_style', "placeholder" => "Parol"])->label(false) ?>
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </div>
                    <div class="form-group form-button">
                            <?= Html::submitButton('Kirish', ['class' => 'form-submit', "id"=>"signin", 'name' => 'login-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
                
                <!-- <div class="social-login">
                    <span class="social-label">Biz bilan aloqa </span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- <div style="min-width: 100%;  padding-right: 20%; padding-left: 20%;">
<p style="font-size: 12px; text-align: center;">
    Ilmingizni baholashdan qo'rqmang! <br>
</p>

<p style="text-align: center; font-size: 12px;">

Har birimiz bu dunyoda tug'ilganimizdan imtihon topshirib kelamiz, balkim siz buni sezmassiz. Oddiy bir misol qilib aytaman, yashash uchun kurash tushunchasini o'zi bir imtihon!
Har bir inson bu hayotda yashar ekan, bir narsani o'ylaydi. Meni ertaga qanday imtihon yoki kelajakda qanday imtihonlar kutyapti deb o'ylaydi.
Demak tushunib yetdikki, bu real hayotda yashashdan qiyin imtihon bo'lmas ekan!
Lekin afsuslar bo'lsinki, o'z bilimini baholashdan qo'rqadigan inson, ertaga jamiyatda oʻz oʻrnini topolmaydi?
Shu o'rinda bir gap aytaman: "XATOLARDAN QO'RQMANG, ULARSIZ YASHAB BO'LMAYDI!" Har bir inson shu tushunchani mag'zini chaqib yetsa, men xursand bo'lardim.
</p>
<p style="font-size: 12px; text-align: right;">
    Muallif: FARID RAXMONOV <br>
</p>

</div> -->

<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });
</script>

<style>
    .input_style{
        border-radius: 0;
    }
</style>