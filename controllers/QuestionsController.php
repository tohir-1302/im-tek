<?php

namespace app\controllers;

use app\models\Questions;
use app\models\QuestionsSearch;
use app\models\TestsNames;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionsController implements the CRUD actions for Questions model.
 */
class QuestionsController extends RoleController
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
     * Lists all Questions models.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $searchModel = new QuestionsSearch();
        $questions = Questions::find()->where(['tests_names_id' => $id])->asArray()->all();
        $tests_names = TestsNames::find()->where(['id'=>$id])->one();
        $model = new Questions();
        $model->tests_names_id = $tests_names->id;
        if ($model->load($this->request->post())) {
            $model->save();
            return $this->redirect(['index', 'id' => $id]);
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $questions,

            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $questions,
            'tests_names' => $tests_names,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Questions model.
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
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Questions();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->tests_names_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Questions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tests_names_id = $model->tests_names_id;
        $model->delete();

        return $this->redirect(['index', 'id' => $tests_names_id]);
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
