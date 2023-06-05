<?php 
//  prd($result)

use app\models\Districts;
use app\models\Regions;
use app\models\TestsNames;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
$this->title = Yii::t('app', 'Monitoring');

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> 
 
<div class="row">
  <div class="col-lg-12">
    <div class="" style="width: 100% !important; margin-left: 20px; margin-top: 15px;">
      <?php $form = ActiveForm::begin(['action' => ['monitoring/monitoring'], 'method'=> 'get', 'options' => ['data-pjax' => 1]]); ?>
          <div class="row">
                  <div class="col-lg-6">
                      <?= $form->field($search, 'tests_names_id')->widget(Select2::classname(), [
                          'data' => TestsNames::getAllTests(),
                          'options' => [ 'class'=>"input_style" ,'placeholder' => 'Tanlang ...', 'multiple' => true],
                          'pluginOptions' => ['allowClear' => true],
                      ])->label(false); ?>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                        <?= $form->field($search, 'regions_id')->widget(Select2::className(), [
                                'data' => Regions::getList(),
                                'options' => ['placeholder' => 'Hudud tanlang', 'class'=>"input_style"],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                              ])->label(false);
                        ?>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <?= $form->field($search, 'districts_id')->widget(Select2::className(), [
                          'data' => Districts::getListAll(),
                          'options' => ['class'=>"" , 'prompt' => 'Tuman(shahar)'],
                          'pluginOptions' => [
                              'allowClear' => true
                          ],
                      ])->label(false); ?>
                    </div>
                  </div>
                  <div class="col-lg-2">
                      <?= Html::submitButton('Ko\'rsatish |  <img src="' . Yii::getAlias("@img") .'/icon/icon_search.svg" alt="">', ['class' => 'btn_1']) ?>
                  </div>
          </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<hr>
    <div>
	    <canvas id="myChart"></canvas>
    </div>

<style>
  #myChart{
    height: 100%;
    max-height: 1000px;
  }

</style>
<?php
// javascriptni sahifaga qo'shish 
ob_start(); ?>

    $(document).ready(function() {
        $("#usersfilter-regions_id").change(function(e){    
            var regions_id = $("#usersfilter-regions_id").val();
            changeClient(regions_id);            
        });


        function changeClient(regions_id){
        $.ajax({
            url: "<?=url(['districts/chosen-type'])?>",
            method: "POST",
            data:{regions_id : regions_id},
            dataType: "json",            
            beforeSend: function(){                        
                $('#usersfilter-districts_id').empty();
                $('#usersfilter-districts_id').append('<option value="">Выберите</option>');
                // clientni tanlay olmaydigan qilib turamiz
                $( "#usersfilter-districts_id" ).prop( "disabled", true );
            },
                 
            success: function(data){
                // console.log(data);                                    
                $.each(data,function(i){
                    $('#usersfilter-districts_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');                
                });
                $( "#usersfilter-districts_id" ).prop( "disabled", false );
                           
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

<script>
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
              <?php foreach ($result as $item) : ?>
                "<?= $item['tuman'] ?>",
              <?php endforeach ;?>
            ],
            datasets: [{ 
                data: [ 
                  <?php foreach ($result as $item) : ?>
                    <?= (int) pul2($item['answer_success'] / $item['question_count'] * 100,2) ?>,
                  <?php endforeach ;?>],
                label: 'O\'zlashtirish ko\'rsatkichi (%)',
                borderColor: "rgb(62,149,205)",
                backgroundColor: "rgb(62,149,205,0.1)",
                borderWidth:2
              }, { 
                data: [
                  <?php foreach ($result as $item) : ?>
                    <?= $item['sign_count'] ?>,
                  <?php endforeach ;?>
                ],
                label: "Test topshiruvchilar soni",
                borderColor: "rgb(60,186,159)",
                backgroundColor: "rgb(60,186,159,0.1)",
                borderWidth:2
              }
            ]
          },
          options: {
            scales: {
                xAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }]
            }
          }
        });
    </script>