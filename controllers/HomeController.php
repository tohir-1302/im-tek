<?php 
namespace app\controllers;

use app\models\TestSingUp;
use Yii;
use yii\base\Controller;
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
            return $this->render('index',[
                'tests' => $result
            ]);
        }

        public function actionSignUpTest(){
            if (Yii::$app->request->isPost) {
               $post = Yii::$app->request->get();
               if ($post['test_names_id']) {
                    $tets_names_id = $post['test_names_id'];
                    $sds = TestSingUp::addSingUp($tets_names_id);
                    prd($sds);
               }
            }
        }
    }
?>