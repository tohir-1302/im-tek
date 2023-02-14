<?php 
namespace app\controllers;

use Yii;
use yii\base\Controller;

    class HomeController extends Controller
    {
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

    }
?>