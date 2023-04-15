<?php 

namespace app\controllers;

use app\models\Districts;
use app\models\User;
use app\models\UsersFilter;
use Yii;

class UsersController extends RoleController
{
    public function actionMyProfile($user_id = null)
    {
        $user = Yii::$app->user->identity;
        if (isset($user_id)) {
            $model = User::findOne(['id' => $user_id]);
        }else{
            $model = User::findOne(['id' => $user->getId()]);
        }
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

    public function actionAllUsers(){
        $user_model = new UsersFilter();

        $all__users = '
            select
                user.*, 
                r.name as r_name, 
                d.name as d_name
            from user
            left join regions r on r.id = user.regions_id
            left join districts d on d.id = user.districts_id
            where 1 = 1
        ';
        if ($user_model->load(Yii::$app->request->get())) {
            if ($user_model->fio) {
                $all__users .= " and (user.first_name like '%$user_model->fio%' or user.last_name like '%$user_model->fio%') ";
            }

            if ($user_model->role) {
                $all__users .= " and user.role = " . $user_model->role;
            }
        }

        $all__users = Yii::$app->getDb()->createCommand($all__users)->queryAll();

        return $this->render('all-users', [
            'all__users' => $all__users,
            'user_model' => $user_model,
        ]);
    }
}

?>