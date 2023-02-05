<?php

namespace app\controllers;

use common\models\User;
use yii\base\Controller;
use yii\filters\AccessControl;

 class RoleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionNewRole() {
        $model = new User()
        $authorizer = \Yii::$app->getModule('rights')->getAuthorizer();
        $authorizer->authManager->assign('clients', $model->id); 

    }

}

?>