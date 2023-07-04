
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use kartik\form\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="<?=Yii::getAlias("@img")?>/signin-image.jpg" alt="sing up image"></figure>
                <?= Html::a('Yangi hisob ochish', ['site/signup'], ['class' => 'btn btn-success', 'style' => 'width: 100%']) ?>
            </div>
            <div class="signin-form">
                <h4 class="form-title"><img src="<?=Yii::getAlias("@img")?>/logo_im_tek.png" alt=""></h4>
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
                
                <div class="social-login">
                    <span class="social-label">Biz bilan aloqa </span>
                    <ul class="socials">
                        <li><a href="https://t.me/im_tek_21" target="_blank"><img class="telegram__" src="<?=Yii::getAlias("@img")?>/telegram.svg" alt="sing up image"></a></li>
                        <li><a href="https://www.youtube.com/@IM-TEK" target="_blank"><img class="youtube__" src="<?=Yii::getAlias("@img")?>/youtube.svg" alt="sing up image"></a></li>
                        <li><a href="https://www.facebook.com/profile.php?id=100091802080307" target="_blank"><img class="facebook__" src="<?=Yii::getAlias("@img")?>/facebook.svg" alt="sing up image"></a></li>
                        <!-- <li><a href="#" target="_blank"><img class="instagram__" src="<?=Yii::getAlias("@img")?>/instagram.svg" alt="sing up image"></a></li> -->
                    </ul>
                </div> 
            </div>
        </div>
    </div>
</section>

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
    .telegram__{
        width: 35px;
        border-radius: 50%;
        transition: .3s ease-in-out;
    }

    .telegram__:hover{
        transition: .3s ease-in-out;
        -webkit-box-shadow: 0px 0px 16.83px 0.17px #0088CC;
    }

    .youtube__{
        width: 35px;
        border-radius: 50%;
        transition: .3s ease-in-out;
    }

    .youtube__:hover{
        transition: .3s ease-in-out;
        -webkit-box-shadow: 0px 0px 16.83px 0.17px #CC0E00;
    }
    .facebook__{
        width: 35px;
        border-radius: 50%;
        transition: .3s ease-in-out;
    }

    .facebook__:hover{
        transition: .3s ease-in-out;
        -webkit-box-shadow: 0px 0px 16.83px 0.17px #395185;
    }
    .instagram__{
        width: 35px;
        border-radius: 50%;
        transition: .3s ease-in-out;
    }

    .instagram__:hover{
        transition: .3s ease-in-out;
        -webkit-box-shadow: 0px 0px 16.83px 0.17px #395185;
    }
</style>