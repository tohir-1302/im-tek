<?php

use app\models\Regions;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Mening Profilim');
?>
    <link rel="stylesheet" href="/web/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<div class="districts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(['id' => 'login-form', "class" => "register-form"]); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'first_name')->textInput(["placeholder" => "Ism"])->label() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'last_name')->textInput([  "placeholder" => "Familiya"])->label() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'father_is_name')->textInput([  "placeholder" => "Sharifi"])->label() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'birthday')->textInput([ "type" => "date"])->label() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'regions_id')->widget(Select2::className(), [
                    'data' => Regions::getList(),
                    'options' => ['placeholder' => 'Hudud tanlang', 'class'=>"input_style"],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    ])->label();
            ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'districts_id')->widget(Select2::className(), [
                    'data' => $districts,
                    'options' => ['placeholder' => 'Tuman(shahar) tanlang', 'class'=>"input_style"],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])->label();
            ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'schools')->textInput(["placeholder" => "Maktab nomi"])->label() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'username')->textInput(["placeholder" => "Foydalanuvchi nomi"])->label() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'password_hash')->passwordInput(['id'=>"password",  "placeholder" => "Parol"])->label('Parol <i class="bi bi-eye-slash" id="togglePassword" style="color: black;"></i>') ?>
        </div>
        <br>
        <div class="col-lg-12" style="text-align: center;">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success','style' => 'width: 40%; font-size: 25px', 'name' => 'login-button', 'data-confirm' => 'O\'zgarishlarni saqlaysizmi?']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>


</div>
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
<?php
// javascriptni sahifaga qo'shish 
ob_start(); ?>

    $(document).ready(function() {
        $("#user-regions_id").change(function(e){    
            var regions_id = $("#user-regions_id").val();
            changeClient(regions_id);            
        });


        function changeClient(regions_id){
        $.ajax({
            url: "<?=url(['districts/chosen-type'])?>",
            method: "POST",
            data:{regions_id : regions_id},
            dataType: "json",            
            beforeSend: function(){                        
                $('#user-districts_id').empty();
                $('#user-districts_id').append('<option value="">Выберите</option>');
                // clientni tanlay olmaydigan qilib turamiz
                $( "#user-districts_id" ).prop( "disabled", true );
            },
                 
            success: function(data){
                // console.log(data);                                    
                $.each(data,function(i){
                    $('#user-districts_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');                
                });
                $( "#user-districts_id" ).prop( "disabled", false );
                           
            },

            error: function(){
                alert('Error - Qayta takrorlang!' + regions_id);
            }
        });
      }

    });
 
<?php $script = ob_get_clean();

$this->registerJs($script);

?>