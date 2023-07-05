<?php 
namespace app\controllers;

use app\models\TestAnswer;
use app\models\TestSingUp;
use app\models\TestsNames;
use app\models\User;
use app\models\UsersFilter;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
    class HomeController extends RoleController
    {

        public function behaviors()
        {
            return array_merge(
                parent::behaviors(),
                [
                    'verbs' => [
                        'class' => VerbFilter::class,
                        'actions' => [
                            'sign-up-test' => ['POST'],
                            'start-test' => ['POST'],
                            'end-test' => ['POST'],
                        ],
                    ],
                ]
            );
        }
    

        public function actionIndex(){
            $user = Yii::$app->user->identity;
            if (in_array($user->role, [User::Teacher])) {
                return $this->redirect(['tests-names/index']);
            }
            $get = Yii::$app->request->get();
            $user = Yii::$app->user->identity;
            $type = 'active';

            if (isset($get['type'])) {
                $type = $get['type'];
            }
            if ($type != 'active' && $type != 'attendees'){
                $type = 'active';
            }
            $sql = '
                    SELECT
                    tests_names.*,
                    c.name AS classes_name,
                    s.name AS sciences_name,
                    IF (tests_names.begin_date < "'.date("Y-m-d H:i:s").'", IF (tests_names.end_date < "'.date("Y-m-d H:i:s").'", "passive", "active" ), "active" ) as xolat
                FROM tests_names
                LEFT JOIN classes c ON c.id = tests_names.classes_id
                LEFT JOIN sciences s ON s.id = tests_names.sciences_id
                where tests_names.status = 2
                order by tests_names.status_date DESC
            ';

            $result = Yii::$app->getDb()->createCommand($sql)->queryAll();
            // prd($result);

            $test_sing_up = TestSingUp::find()->where(['user_id' => $user->getId()])->all();
            // prd($test_sing_up);

            $gibrit = [];
            foreach ($result as $item) {
                foreach ($test_sing_up as $data) {
                    if ($data->tests_names_id == $item['id']) {
                        if ($item['end_date'] >= date("Y-m-d H:i:s") && $data->tests_status == 4 ) {
                            $data->tests_status = 1;
                            $data->save(); 
                        }
                    }
                }
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
                    "sertifikat_foiz" => $item['sertifikat_foiz'],
                    "has_special_test" => $item['has_special_test'],
                    "sertificat_status" => $item['sertificat_status'],
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
                            $gibrit[$item['id']]['sing_up_question_count'] = $data->question_count;
                            $gibrit[$item['id']]['sing_up_answer'] = $data->answer_success;
                            $gibrit[$item['id']]['tests_status'] = $data->tests_status;
                        }else{
                            $gibrit[$item['id']]['sing_up_id'] = $data->id;
                            $gibrit[$item['id']]['sing_up_question_count'] = $data->question_count;
                            $gibrit[$item['id']]['sing_up_answer'] = $data->answer_success;
                            $gibrit[$item['id']]['tests_status'] = $data->tests_status;
                        }
                    }
                }

                if ($item['xolat'] == "passive" && !$bor) {
                   unset($gibrit[$item['id']]);
                }
            }

            $gibrit_new = [];
            foreach ($gibrit as $item) {
                if ($type == 'active' && in_array($item['tests_status'] , [0, 1, 2])) {
                    $gibrit_new = array_merge($gibrit_new,  [$gibrit[$item['id']]]);
                }else if ($type == 'attendees' && in_array($item['tests_status'] , [3, 4])) {
                    $gibrit_new = array_merge($gibrit_new,  [$gibrit[$item['id']]]);
                }
            }

            return $this->render('index',[
                'tests' => $gibrit_new,
                'type' => $type
            ]);
        }


        public function actionSignUpTest()
        {
            if (Yii::$app->request->isPost) {
               $post = Yii::$app->request->post();
               if ($post['test_names_id']) {
                    $tets_names_id = $post['test_names_id'];
                    
                    $result = TestSingUp::addSingUp($tets_names_id);
                    if($result){
                        \Yii::$app->session->setFlash('success', "Ro'yxatdan muvaffaqiyatli o'tdingiz !!!" );
                        return $this->redirect('index');
                    }else{
                        \Yii::$app->session->setFlash('danger', "Xatolik !!! Hisobingizni tekshiring!" );
                        return $this->redirect('index');
                    }
               }
            }
        }


        public function actionSpecialTest()
        {
            $tests_names_id = null;
            $password = null;

            $get = Yii::$app->request->get();
            if (isset($get['tests_names_id'])) {
               $tests_names_id = $get['tests_names_id'];
            }

            if ($this->request->post()) {
                $post = $this->request->post();
                $tests_names_id = $post['tests_names_id'];
                $password = $post['password'];

                $validate = TestsNames::validateSpecilaTest($tests_names_id, $password);
                if ($validate) {
                    $result = TestSingUp::addSingUp($tests_names_id);
                    if($result){
                        \Yii::$app->session->setFlash('success', "Ro'yxatdan muvaffaqiyatli o'tdingiz !!!" );
                        return $this->redirect('index');
                    }else{
                        \Yii::$app->session->setFlash('danger', "Xatolik !!! Hisobingizni tekshiring!" );
                        return $this->redirect('index');
                    }
                }else{
                    \Yii::$app->session->setFlash('danger', "Parol xato !!!" );
                    return $this->render('special-test', [
                        'tests_names_id' => $tests_names_id,
                        'password' => $password
                    ]);
                }
            }
            
            return $this->render('special-test', [
                'tests_names_id' => $tests_names_id,
                'password' => $password
            ]);
            
        }

        
        public function actionTest(){
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                if ($post['test_names_id']) {
                    $tets_names_id = $post['test_names_id'];
                    $validateDate = TestsNames::validateDate($tets_names_id);
                    if($validateDate){
                        $question_number = isset($post['question_number']) ? $post['question_number'] : 1;
                        $result = TestAnswer::getOneQuestions($question_number, $tets_names_id);
                        if ($result == -1) {
                            \Yii::$app->session->setFlash('danger', "Test yakunlandi" );
                            return $this->redirect('index');
                        }
                        return $this->render('test',[
                            'result' => $result,
                        ]);
                    }else{
                        \Yii::$app->session->setFlash('danger', "Test hali boshlanmadi" );
                        return $this->redirect('index');
                    }
                }
            }
        }

        /**
         * test tugatish
         */
        public function actionEndTest(){
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $test_singup_id = $post['test_singup_id'];
                $test_answer = TestAnswer::findAll(['test_sing_up_id' => $test_singup_id]);

                $answer_success = 0;
                foreach ($test_answer as $item) {
                    if ($item->answer_client == $item->answer_success) {
                        $answer_success++;
                    }
                }

                $test_sing_up = TestSingUp::findOne(['id' => $test_singup_id]);
                $test_sing_up -> end_test_date = date("Y-m-d H:i:s");
                $test_sing_up -> tests_status = 3;
                $test_sing_up -> answer_success = $answer_success;
                $test_sing_up -> save();
                return $this->redirect(['view', 'test_singup_id' => $test_singup_id]);
            }

            \Yii::$app->session->setFlash('danger', "Test yakunlandi" );
            return $this->redirect('index');
        }


        /**
         * test variantlarini belgilashda ishlatildi
         */

        public function actionCheckAnswer()
        {
            $test_answer_id = $_REQUEST['test_answer_id'];
            $answer = $_REQUEST['answer'];
            $test_answer = TestAnswer::findOne(['id' => $test_answer_id]);
            $test_answer->answer_client = $answer;

            if ( $test_answer->save()) {
                return json_encode(['status' => true]);
            }else{
                return json_encode(['status' => false]);
            }
            
        }


        public function actionView($test_singup_id){
            $allQuestions = TestAnswer::getAllQuestions($test_singup_id);
            $test_sing_up = TestSingUp::find()->where(['id' => $test_singup_id])->one();
            $tets_names = TestsNames::find()->where(['id' => $test_sing_up->tests_names_id])->one();
            $true_answer = 0;

            foreach ($allQuestions as $item) {
                if ($item['answer_success'] == $item['answer_client']) {
                    $true_answer++;
                }
            }

            // prd($tets_names);
            return $this->render('view',[
                'allQuestions' => $allQuestions,
                'test_sing_up' => $test_sing_up,
                'tets_names' => $tets_names,
                'true_answer' => $true_answer
            ]);
        }
     
}
?>