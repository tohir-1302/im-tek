<?php 

namespace app\controllers;

use app\models\UsersFilter;
use Yii;

class MonitoringController extends RoleController
{
   public function actionMonitoring(){
    
    $search = new UsersFilter();
    $search->regions_id = 1;
 
    $sql = '
        SELECT 
            d.name AS tuman,
            d.id tuman_id,
            r.name AS viloyat,
            COUNT(tsu.id) AS sign_count,
            sum(tsu.answer_success) AS answer_success,
            SUM(tn.question_count) AS question_count
        FROM test_sing_up tsu
        LEFT JOIN user u ON u.id = tsu.user_id
        LEFT JOIN tests_names tn ON tn.id = tsu.tests_names_id
        LEFT JOIN regions r ON r.id = u.regions_id
        LEFT JOIN districts d ON d.id = u.districts_id
        WHERE tsu.tests_status = 3 ';

    if (Yii::$app->request->isGet && $search->load(Yii::$app->request->get())) {
        $get = Yii::$app->request->get(); 
        if (isset($get['UsersFilter']['tests_names_id']) && is_array($get['UsersFilter']['tests_names_id'])) {
            $sql .= ' and tn.id in ('. implode(",",$get['UsersFilter']['tests_names_id']) .') ';
            $search->tests_names_id = $get['UsersFilter']['tests_names_id'];
        }

        if (($get['UsersFilter']['regions_id']) > 0) {
            $sql .= ' and r.id = '. $get['UsersFilter']['regions_id'];
        }
        $sql .= ' GROUP BY d.id ';

    } else {
        $sql .= ' and r.id = ' . $search->regions_id;
        $sql .= ' GROUP BY d.id ';
    }

    $result = Yii::$app->getDb()->createCommand($sql)->queryAll();
    return $this->render('monitoring', [
        'result' =>  $result,
        'search' => $search
    ]);

   }
}

?>