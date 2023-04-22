<?php 
//  prd($result)

use app\models\Districts;
use app\models\Regions;
use app\models\TestsNames;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
  <?php Pjax::begin(); ?>
    <div id="chart_div"></div>
  <?php Pjax::end(); ?> 

<style>
  #chart_div{
    height: 100%;
    min-height: 600px;
    margin: 20px;
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
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var button = document.getElementById('change-chart');
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable([
          ['Tumanlar', 'O\'zlashtirish ko\'rsatkichi (%)', 'Test topshiruvchilar soni'],
          <?php foreach ($result as $item) : ?>
            ["<?= $item['tuman'] ?>", <?= (int) pul2($item['answer_success'] / $item['question_count'] * 100,2) ?> + "%", <?= $item['sign_count'] ?>],
          <?php endforeach ;?>
        ]);

        var materialOptions = {
          chart: {
            // title: 'Nearby galaxies',
            // subtitle: 'distance on the left, brightness on the right'
          },
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          animation: {
        duration: 1000,
        easing: 'in'
      },
      hAxis: {viewWindow: {min:0, max:5}},
          axes: {
            y: {
              distance: {label: 'O\'zlashtirish ko\'rsatkichi (%)'}, // Left y-axis.
              brightness: {side: 'right', label: 'Test topshiruvchilar soni'} // Right y-axis.
            }
          }
        };

        var classicOptions = {
          width: 1,
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          animation: {
        duration: 1000,
        easing: 'in'
      },
          title: 'Nearby galaxies - distance on the left, brightness on the right',
          vAxes: {
            // Adds titles to each axis.
            0: {title: 'O\'zlashtirish ko\'rsatkichi (%)'},
            1: {title: 'Test topshiruvchilar soni'}
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }

        drawMaterialChart();
    };
    </script>
