<?php

namespace app\controllers;

use app\models\TestSingUp;
use app\models\TestsNames;
use app\models\TestsNamesSearch;
use Exception;
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

        $searchModel = new TestsNamesSearch();
        $query = TestsNames::find()
        ->select('tests_names.*, s.name as s_name, c.name as c_name')
        ->leftJoin('sciences s','s.id = tests_names.sciences_id')
        ->leftJoin('classes c','c.id = tests_names.classes_id')->orderBy(['create_date' => SORT_DESC]);

        if ($searchModel->load(Yii::$app->request->get())) {
            if ($searchModel->sciences_id) {
                $query =  $query->where(['s.id' => $searchModel->sciences_id]);
            }
            if ($searchModel->classes_id) {
                $query =  $query->where(['c.id' => $searchModel->classes_id]);
            }
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

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->create_date = date("Y-m-d H:i:s");
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
        $this->findModel($id)->delete();

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

        if (isset($get['tests_names_id'])) {

            $date_now = date("Y-m-d H:i:s");
            $tets_names_id = $get['tests_names_id'];

            $test_sing_up = TestSingUp::findAll(['tests_names_id'=> $tets_names_id]);
            foreach ($test_sing_up as $item) {
                if ($item->end_date <= $date_now) {
                    $item->tests_status = 3;
                    $item->end_test_date = $item->end_date;
                    $item->save();
                }
            }


            $tets_names = TestsNames::findOne(['id' => $tets_names_id]);
            $sql = '
            SELECT
                CONCAT(u.first_name, " ", u.last_name) AS fio,
                tsu.*
            FROM test_sing_up tsu
            LEFT JOIN user u on tsu.user_id = u.id
            where tsu.tests_names_id = :tests_names_id
            ';
            $result = Yii::$app->getDb()->createCommand($sql,[':tests_names_id' => $tets_names_id])->queryAll();
            // prd($result);
            return $this->render('test-users', [
                'result' => $result,
                'tets_names' => $tets_names
            ]);
        }
    }
}
