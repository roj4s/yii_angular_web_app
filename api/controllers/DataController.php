<?php

namespace app\controllers;


use yii\rest\ActiveController;


class DataController extends ActiveController
{

    public function actionIndex(){

        return ['hola'];

    }

}