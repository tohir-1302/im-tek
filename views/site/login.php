<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
  <head>
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container_">
      <div class="forms-container">
        <div class="signin-signup">

          <form action="#" class="sign-in-form">
            <h2 class="title">Kirish</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Login" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Parol" />
            </div>
            <input type="submit" value="Kirish" class="btn solid" />
          </form>

          <form action="<?= Url::to(['site/signup']) ?>" class="sign-up-form" method="post">
            <h2 class="title">Ro'yxatdan o'tish</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Ism" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Familiya" />r
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Sharif" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Login" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Parol" />
            </div>
            <input type="submit" class="btn" value="Yuborish" />
          </form>


          <?php /* $form = ActiveForm::begin([
                  'action' => ['signup'],
                  'method' => 'post',
                  'class' => 'sign-up-form',
                  'options' => [
                      'data-pjax' => 1
                  ],
              ]); ?>
            <div class="input-field">
              <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'login'])->label(false) ?>
              </div>
              <div class="form-group">
                  <?= Html::submitButton('Yuborish', ['class' => 'btn', 'name' => 'signup-button']) ?>
              </div>


          <?php ActiveForm::end();  */?>

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Ro'yxatdan o'tganmisiz ?</h3>
            <p>
             Agar ro'yxatdan o'tmagan bo'lsangiz tizimga kirolmaysiz!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Ro'yxatdan o'tish
            </button>
          </div>
          <img src="<?=Yii::getAlias('@img')?>/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Ilgari ro`yxatdan o`tganmisiz ? </h3>
            <p>
              Agar oldin ro`yxatdan o`tgan bo`lsangiz kirish bo`limiga o`ting.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Kirish
            </button>
          </div>
          <img src="<?=Yii::getAlias('@img')?>/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

  </body>
