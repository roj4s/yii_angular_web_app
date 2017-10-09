<?php
/**
 * Created by PhpStorm.
 * User: yadini
 * Date: 07/10/17
 * Time: 17:47
 */

namespace app\controllers;

use app\models\Department;
use CorsCustom;
use yii\rest\ActiveController;
use yii\web\Response;

class DepartmentController extends ActiveController
{

    public $modelClass = 'app\models\Department';

    private $_verbs = ['GET','OPTIONS'];

    public function actionOptions ()
    {
        if (\Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            \Yii::$app->getResponse()->setStatusCode(405);
        }
        $options = $this->_verbs;
        \Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', $options));
//        \Yii::$app->getResponse()->getHeaders()->set('')
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actionByid(){

        $id = \Yii::$app->request->get('id', 1);
        return Department::findAll(['id'=>$id]);

    }

}