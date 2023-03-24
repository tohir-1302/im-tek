<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h5 class="form-title">Yangi hisob yaratish</h5>
                <br>
                <?php $form = ActiveForm::begin(['id' => 'login-form', "class" => "register-form"]); ?>
                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'first_name')->textInput([ 'class' => 'input_style', "placeholder" => "Ism"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'last_name')->textInput([ 'class' => 'input_style', "placeholder" => "Familiya"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'father_is_name')->textInput([ 'class' => 'input_style', "placeholder" => "Sharifi"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'username')->textInput([ 'class' => 'input_style', "placeholder" => "Foydalanuvchi nomi"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <!-- <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label> -->
                        <?= $form->field($model, 'email')->textInput(['class' => 'input_style', "placeholder" => "E-pochta"])->label(false) ?>
                    </div>
                    <div class="form-group" style="display: flex;">
                        <!-- <label for="your_pass"><i class="zmdi zmdi-lock"></i></label> -->
                        <?= $form->field($model, 'password')->passwordInput(['id'=>"password", 'class' => 'input_style', "placeholder" => "Parol"])->label(false) ?>
                        <i class="bi bi-eye-slash" id="togglePassword" style="color: black;"></i>
                    </div>
                    <div class="form-group form-button">
                            <?= Html::submitButton('Saqlash', ['class' => 'form-submit', "id"=>"signin", 'name' => 'login-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="signup-image">
                <figure><img src="<?=Yii::getAlias("@img")?>/signup-image.jpg" alt="sing up image"></figure>
                <?= Html::a('Men ilgari hisob yaratganman', ['site/login'], ['class' => 'btn btn-success']) ?>
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