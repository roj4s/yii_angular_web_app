<?php
/**
 * Created by PhpStorm.
 * User: yadini
 * Date: 07/10/17
 * Time: 18:11
 */

namespace app\controllers;

use app\models\Department;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;


class ProductController extends ActiveController
{

    public $modelClass = 'app\models\Product';

    private $_verbs = ['GET','OPTIONS','PUT', 'POST'];

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

    public function actionGetRandomImages(){

        $rows = (new \yii\db\Query())
            ->select([
                'p.id as product_id',
                'p.name as product_name',
                'i.thumbnail_url',
                'i.large_url',
                'i.url'
            ])
            ->from('Product p')
            ->innerJoin('ProductImage pi', 'pi.product = p.id')
            ->innerJoin('Image i','pi.image = i.id')
            ->where("i.url is not null")
            ->limit(10)
            ->all();

        return $rows;

    }

    public function actionWithImage(){

        $department_id = \Yii::$app->request->get('department',-1);

        if($department_id == -1)
            $department_id = Department::find()->one()->id;

        $rows = (new \yii\db\Query())
            ->select([
                'p.id as product_id',
                'p.name as product_name',
                'i.thumbnail_url',
                'i.large_url',
                'i.url',
                'p.short_description',
                'd.name as department_name',
                'p.price'
            ])
            ->from('Product p')
            ->innerJoin('ProductImage pi', 'pi.product = p.id')
            ->innerJoin('Image i','pi.image = i.id')
            ->innerJoin('Department d', 'p.department = d.id')
            ->where("i.url is not null")
            ->andWhere("p.department = $department_id")
            ->limit(10)
            ->all();

        return $rows;

    }

    public function actionByDepartment(){

        $department_id = \Yii::$app->request->get('department',-1);

        if($department_id == -1){
            return "a";
            $dep = Department::findOne([]);
            return Product::findOne([
                'department' => $dep->id
            ]);

        }

        return Product::findAll([
            'department' => $department_id
        ]);



        }

        public function actionDelete(){

            $id = \Yii::$app->request->get('id', -1);
            if(!$id == -1)
            {

            $product = Product::findOne(['id' => $id]);
            if($product){
                $product->delete();

                return "Deleted";
            }

            }
          return "Didn't delete";

        }

}