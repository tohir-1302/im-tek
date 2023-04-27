<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\TestSingUp;
use app\models\TestsNames;
use ErrorException;

class SiteController extends RoleController
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        // 'logout' => ['post'],
                        // 'signup' => ['post']
                    ],
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'loginHeader';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    
    public function actionSertificate($test_singup_id){

        $test_sing_up = 'SELECT
                            tsu.*,
                            CONCAT(u.last_name, " ", u.first_name, " ", u.father_is_name) AS fio,
                            r.name AS viloyat,
                            d.name AS tuman,
                            s.name as fan
                        FROM test_sing_up tsu
                        LEFT JOIN user u ON u.id = tsu.user_id
                        left join tests_names tn on tn.id = tsu.tests_names_id
                        left join sciences s on s.id = tn.sciences_id
                        LEFT JOIN regions r ON r.id = u.regions_id
                        LEFT JOIN districts d ON d.id = u.districts_id
                        WHERE tsu.id = ' . $test_singup_id;
        $test_sing_up = Yii::$app->getDb()->createCommand($test_sing_up)->queryOne();
        $pdf = Yii::$app->pdf;
        $html = $this->renderPartial('sertificate', [
            'test_sing_up' => $test_sing_up,
        ]);

        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->WriteHtml($html); // call mpdf write html
        echo $mpdf->Output("sertificat [ ".date('Y-m-d H:i:s') ."].pdf", 'I');
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'loginHeader';
        
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Ro\'yxatdan oʻtganingiz uchun tashakkur. Platformamizdan foydalanishingiz mumkin !!!');
            return $this->goHome();
        }

        $model->birthday = "2000-01-01";
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
