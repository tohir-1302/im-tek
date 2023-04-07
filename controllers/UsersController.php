<?php 

namespace app\controllers;

use app\models\Districts;
use app\models\User;
use Yii;

class UsersController extends RoleController
{
    public function actionMyProfile($user_id = null)
    {
        $user = Yii::$app->user->identity;
        $model = User::findOne(['id' => $user->getId()]);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash('success', "O'zgarishlar muvaffaqiyatli saqlandi!" );
                return $this->redirect(['tests-names/index']);
            }
        }
        $districts = Districts::getList($model->regions_id);
        return $this->render('my-profile', [
            'model' => $model,
            'districts' => $districts
        ]);
    }

}

?>