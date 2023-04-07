<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use app\models\Districts;
use app\models\Regions;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
// use yii\bootstrap5\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\Url;

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
                        <?= $form->field($model, 'first_name')->textInput([ 'class' => 'input_style', "placeholder" => "Ism"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'last_name')->textInput([ 'class' => 'input_style', "placeholder" => "Familiya"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'father_is_name')->textInput([ 'class' => 'input_style', "placeholder" => "Sharifi"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <p>Tug'ilgan kun</p>
                        <?= $form->field($model, 'birthday')->textInput(['class' => 'input_style', "type" => "date"])->label(false) ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?= $form->field($model, 'regions_id')->widget(Select2::className(), [
                                        'data' => Regions::getList(),
                                        'options' => ['placeholder' => 'Viloyat', 'class'=>"input_style"],
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                     ])->label(false);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?= $form->field($model, 'districts_id')->widget(Select2::className(), [
                                        'data' => [],
                                        'options' => ['placeholder' => 'Tuman', 'class'=>"input_style"],
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ])->label(false);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'schools')->textInput([ 'class' => 'input_style', "placeholder" => "Maktab"])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'username')->textInput([ 'class' => 'input_style', "placeholder" => "Foydalanuvchi nomi"])->label(false) ?>
                    </div>
                    <div class="form-group"  style="display: flex">
                        <?= $form->field($model, 'email')->textInput(['class' => 'input_style', "placeholder" => "E-pochta"])->label(false) ?>
                    </div>
                    <div class="form-group" style="display: flex;">
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
                <?= Html::a('Men ilgari hisob yaratganman', ['site/login'], ['class' => 'btn btn-success',  'style' => 'width: 100%']) ?>
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


<?php
// javascriptni sahifaga qo'shish 
ob_start(); ?>

    $(document).ready(function() {
        $("#signupform-regions_id").change(function(e){    
            var regions_id = $("#signupform-regions_id").val();
            changeClient(regions_id);            
        });


        function changeClient(regions_id){
        $.ajax({
            url: "<?=url(['districts/chosen-type'])?>",
            method: "POST",
            data:{regions_id : regions_id},
            dataType: "json",            
            beforeSend: function(){                        
                $('#signupform-districts_id').empty();
                $('#signupform-districts_id').append('<option value="">Выберите</option>');
                // clientni tanlay olmaydigan qilib turamiz
                $( "#signupform-districts_id" ).prop( "disabled", true );
            },
                 
            success: function(data){
                // console.log(data);                                    
                $.each(data,function(i){
                    $('#signupform-districts_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');                
                });
                $( "#signupform-districts_id" ).prop( "disabled", false );
                           
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