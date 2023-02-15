<?php 
namespace app\controllers;

use app\models\TestSingUp;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

    class HomeController extends Controller
    {

        public function behaviors()
        {
            return array_merge(
                parent::behaviors(),
                [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'sign-up-test' => ['POST'],
                        ],
                    ],
                ]
            );
        }
    

        public $layout = 'ClientHeader';

        public function actionIndex(){

            $sql = '
                    SELECT
                    tests_names.*,
                    c.name AS classes_name,
                    s.name AS sciences_name,
                    IF (tests_names.begin_date < "'.date("Y-m-d").'", IF (tests_names.end_date < "'.date("Y-m-d").'", "passive", "active" ), "active" ) as xolat
                FROM tests_names
                LEFT JOIN classes c ON c.id = tests_names.classes_id
                LEFT JOIN sciences s ON s.id = tests_names.sciences_id
                order by tests_names.create_date
            ';

            $result = Yii::$app->getDb()->createCommand($sql)->queryAll();
            // prd($result);

            $test_sing_up = TestSingUp::find()->all();
            // prd($test_sing_up);

            $gibrit = [];
            foreach ($result as $item) {
                $gibrit[$item['id']] =[
                    "id" => $item['id'],
                    "name" => $item['name'],
                    "classes_name" => $item['classes_name'],
                    "sciences_name" => $item['sciences_name'],
                    "time_limit" => $item['time_limit'],
                    "question_count" => $item['question_count'],
                    "begin_date" => $item['begin_date'],
                    "end_date" => $item['end_date'],
                    "xolat" => $item['xolat'],
                    "sing_up_id" => null,
                    "tests_status" => null
                ];

                $bor = false;
                foreach ($test_sing_up as $data) {
                    if ($data->tests_names_id == $item['id']) {
                        $bor = true;
                        if ($item['xolat'] == "passive" && $data->end_date == null) {
                            $data->tests_status = 4;
                            $data->save(); 
                            $gibrit[$item['id']]['sing_up_id'] =$data->id;
                            $gibrit[$item['id']]['tests_status'] = $data->tests_status;
                        }else{
                            $gibrit[$item['id']]['sing_up_id'] =$data->id;
                            $gibrit[$item['id']]['tests_status'] = $data->tests_status;
                        }
                    }
                }

                if ($item['xolat'] == "passive" && !$bor) {
                   unset($gibrit[$item['id']]);
                }

            }
            return $this->render('index',[
                'tests' => $gibrit
            ]);
        }

        public function actionSignUpTest()
        {
            if (Yii::$app->request->isPost) {
               $post = Yii::$app->request->get();
               if ($post['test_names_id']) {
                    $tets_names_id = $post['test_names_id'];
                    $result = TestSingUp::addSingUp($tets_names_id);
                    if($result){
                        \Yii::$app->session->setFlash('success', "Ro'yxatdan muvaffaqiyatli o'tdingiz !!!" );
                        return $this->redirect('index');
                    }else{
                        \Yii::$app->session->setFlash('success', "Xatolik !!! Hisobingizni tekshiring!" );
                        return $this->redirect('index');
                    }
               }
            }
        }       
    }
?>