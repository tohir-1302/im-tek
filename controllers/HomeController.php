<?php 
namespace app\controllers;

use yii\base\Controller;

    class HomeController extends Controller
    {
        public $layout = 'ClientHeader';

        public function actionIndex(){

            return $this->render('index');
        }

    }
?>