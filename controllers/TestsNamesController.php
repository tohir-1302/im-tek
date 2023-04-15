<?php

namespace app\controllers;

use app\models\Questions;
use app\models\TestAnswer;
use app\models\TestSingUp;
use app\models\TestsNames;
use app\models\TestsNamesSearch;
use app\models\User;
use app\models\UsersFilter;
use Exception;
use Symfony\Component\Console\Question\Question;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestsNamesController implements the CRUD actions for TestsNames model.
 */
class TestsNamesController extends RoleController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TestsNames models.
     *
     * @return string
     */

     
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        if (!in_array($user->role, [User::Admin, User::Teacher])) {
            return $this->redirect(['home/index']);
        }
        $searchModel = new TestsNamesSearch();
        $query = TestsNames::find()
        ->select('tests_names.*, s.name as s_name, c.name as c_name, u.username')
        ->leftJoin('sciences s','s.id = tests_names.sciences_id')
        ->leftJoin('user u','u.id = tests_names.user_id')
        ->leftJoin('classes c','c.id = tests_names.classes_id')->orderBy(['create_date' => SORT_DESC]);

        if ($searchModel->load(Yii::$app->request->get())) {
            if ($searchModel->sciences_id) {
                $query =  $query->where(['s.id' => $searchModel->sciences_id]);
            }
            if ($searchModel->classes_id) {
                $query =  $query->where(['c.id' => $searchModel->classes_id]);
            }
        }
        if ($user->role != User::Admin) {
            $query = $query->andWhere(['tests_names.user_id' => $user->getId()]);
        }

        $query = $query->asArray()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $query,
        ]);
    }

    
    /**
     * Displays a single TestsNames model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
 
    /**
     * Creates a new TestsNames model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TestsNames();
        $user = Yii::$app->user->identity;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->create_date = date("Y-m-d H:i:s");
                $model->user_id = $user->getId();
                $model->save();
                return $this->redirect(['questions/index', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $model->time_limit = '00:20:00';
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TestsNames model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TestsNames model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Questions::deleteAll(['tests_names_id'=>$id]);
        $this->findModel($id)->delete();
        \Yii::$app->session->setFlash('success', "Testlar o'chirildi!" );
        return $this->redirect(['index']);
    }

    /**
     * Finds the TestsNames model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TestsNames the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestsNames::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionStatus(){
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->get();
            if ($post['id']) {
                 $tets_names_id = $post['id'];
                 $result = TestsNames::UpdateStatus($tets_names_id);

                 if($result){
                     \Yii::$app->session->setFlash('success', "Clientga muvaffaqiyatli o'tkazildi !!!" );
                     return $this->redirect('index');
                 }else{
                     \Yii::$app->session->setFlash('danger', "Testlar soni kam!" );
                     return $this->redirect('index');
                 }
            }
         }
    }

    public function actionTestUsers(){
        $get = Yii::$app->request->get();
        // prd($get);
        if (isset($get['tests_names_id']) || isset($get['UsersFilter']['tests_names_id'])) {

            $date_now = date("Y-m-d H:i:s");
            $test_names_id = isset($get['tests_names_id']) ? $get['tests_names_id'] : $get['UsersFilter']['tests_names_id'];

            $test_sing_up = TestSingUp::findAll(['tests_names_id'=> $test_names_id]);
            foreach ($test_sing_up as $item) {
                if ($item->tests_status = 2) {
                    $test_answer = TestAnswer::findAll(['test_sing_up_id' => $item['id']]);

                    $answer_success = 0;
                    foreach ($test_answer as $item_) {
                        if ($item_->answer_client == $item_->answer_success) {
                            $answer_success++;
                        }
                    }
                    if ($item->end_date <= $date_now) {
                        $item->tests_status = 3;
                        $item->end_test_date = $item->end_date;
                        $item->answer_success = $answer_success;
                        $item->save();
                    }
                }
            }


            $tets_names = TestsNames::findOne(['id' => $test_names_id]);
            $sql = '
            SELECT
                CONCAT(u.first_name, " ", u.last_name) AS fio,
                tsu.*,
                d.name as districts_name,
                r.name as regions_name,
                u.schools
            FROM test_sing_up tsu
            LEFT JOIN user u on tsu.user_id = u.id
            left join regions r on r.id = u.regions_id
            left join districts d on d.id = u.districts_id
            where tsu.tests_names_id = :tests_names_id
            ';
            $user_model = new UsersFilter();
            
            if ($user_model->load(Yii::$app->request->get())) {
                if ($user_model->regions_id) {
                    $sql .= ' and r.id =  '. $user_model->regions_id;
                }
                if ($user_model->districts_id) {
                    $sql .= ' and d.id =  '. $user_model->districts_id;
                }

                if ($user_model->schools) {
                    $sql .= " and u.schools like '%$user_model->schools%'";
                }

                if ($user_model->tests_names_id) {
                    $test_names_id = $user_model->tests_names_id;
                }
            }
            $result = Yii::$app->getDb()->createCommand($sql,[':tests_names_id' => $test_names_id])->queryAll();
            
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                // 'sort' => [
                //     'defaultOrder' => [
                //         'j_summa' => 'SORT_DESC',
                //     ],
    
                //     'attributes' => [
                //         'j_summa', 'j_amount', 'chiqim_summa', 'chiqim_amount', 'kirim_amount', 'kirim_summa', 'b_summa', 'b_amount'
                //     ],
                // ],
                'pagination' => [
                    'pageSize' => 0,
                ],
            ]);

            return $this->render('test-users', [
                'dataProvider' => $dataProvider,
                'result'=>$result,
                'user_model'=>$user_model,
                'tets_names' => $tets_names,
                'tests_names_id' => $test_names_id
            ]);
        }
    }

    public function actionResetTest($test_singup_id, $tests_names_id){
        TestAnswer::deleteAll(['test_sing_up_id'=>$test_singup_id]);
        TestSingUp::deleteAll(['id'=>$test_singup_id]);

        return $this->redirect(['tests-names/test-users', 'tests_names_id' => $tests_names_id]);

    }
        
}
