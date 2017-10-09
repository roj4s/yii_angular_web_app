<?php

namespace app\controllers;

use app\models\Department;
use app\models\Product;
use app\models\ProductImage;
use Yii;
use yii\base\Behavior;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{


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
        return array_merge(parent::behaviors(), [

            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin' => ["*"],
                    'Access-Control-Request-Method'    => ['GET', 'POST', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],

        ]);
    }

    public function actionPopulateDepartments(){

        $icons = [
            'accessibility'
        ];

        $departments = Department::find()->all();

        if(count($departments) > 10)
            return "Don't need to populate. Successfully";

        foreach ($departments as $d)
            $d->delete();

        $categories_data = UtilController::CallAPI("GET",
            "http://api.walmartlabs.com/v1/taxonomy?format=json&apiKey=ajhqar6m79xzx3dabqv89mvf");

        $categories_data = json_decode($categories_data, true);

        $i = 0;
        $toc = 0;

        $con = Yii::$app->db;
        $txn = $con->beginTransaction();
        foreach ($categories_data['categories'] as $category) {

            Yii::$app->db->createCommand()->insert('Department', [
                'name' => $category['name'],
                'description' => $category['id'],
                'icon_class' => $icons[random_int(0, count($icons) - 1)]
            ])->execute();


            $toc ++;
            if($toc % 100 == 0)
                $txn->commit();

            $i ++;
            if($i == 15)
               break;
        }

        $txn->commit();
        $con->close();
        return "Done $toc insertions";

    }


    public function actionPopulateProducts(){

        $products = Product::find()->all();


        foreach ($products as $d)
            $d->delete();

        $departments = Department::find()->all();

        $i = 0;
        $toc = 0;
        $faker = \Faker\Factory::create();

        $con = Yii::$app->db;
        $txn = $con->beginTransaction();
        foreach ($departments as $d){
            /* @var $d Department */
            $cat_id = $d->description;

            $url = "http://api.walmartlabs.com/v1/search?query=%2A&format=json&categoryId=$cat_id&apiKey=ajhqar6m79xzx3dabqv89mvf";

            $pds = UtilController::CallAPI("GET",$url);

            $pds = json_decode($pds, true);

            foreach ($pds['items'] as $item) {

                Yii::$app->db->createCommand()->insert('Product', [
                    'name' => $item['name'],
                    'price' => isset($item['salePrice'])? floatval($item['salePrice']): 45,
                    'count' => random_int(0, 100),
                    'color' => $faker->colorName(),
                    'department' => $d->id,
                    'long_description' => isset($item['longDescription']) ? substr($item['longDescription'], 0, 200): "",
                    'short_description' => isset($item['shortDescription']) ? substr($item['shortDescription'], 0, 200) : ""
                ])->execute();

                $toc ++;
                if($toc % 100 == 0)
                    $txn->commit();

                $i ++;
                if($i == 10)
                    break;
            }
        }

        try{
        $txn->commit();
        }catch (
            \Exception $e
        ){}

        $con->close();
        return "Done $toc insertions";

    }


    public function actionPopulateImages(){

        $products = Product::find()->all();


        $toc = 0;

        $con = Yii::$app->db;


        foreach ($products as $p){
            /* @var $p Product */
            $i = 0;

            $already_in_db = ProductImage::findAll([
                'product' => $p->id
            ]);

            if(count($already_in_db) > 5)
                continue;

            $p_name = explode(" ", $p->name)[0];
            $cat_id = $p->department0->description;

            $pds = UtilController::CallAPI("GET",
                "http://api.walmartlabs.com/v1/search?query=$p_name&format=json&categoryId=$cat_id&apiKey=ajhqar6m79xzx3dabqv89mvf");


            $pds = json_decode($pds, true);


            $pd = $pds['items'][0];


            if(!isset($pd['imageEntities'])){

                $pd['imageEntities'] = [
                    [
                        "mediumImage" => $pd['mediumImage'],
                        "thumbnailImage" => $pd['thumbnailImage'],
                        "largeImage" => $pd['largeImage'],
                    ]
                ];
            }

            foreach ($pd['imageEntities'] as $imageEntity){


                $txn = $con->beginTransaction();

                Yii::$app->db->createCommand()->insert('Image', [
                    'url' => $imageEntity['mediumImage'],
                    'thumbnail_url' => $imageEntity['thumbnailImage'],
                    'large_url' => $imageEntity['largeImage'],
                ])->execute();

                $image_id = Yii::$app->db->lastInsertID;

                $toc ++;

                Yii::$app->db->createCommand()->insert('ProductImage', [
                    'image' => $image_id,
                    'product' => $p->id,
                ])->execute();

                $txn->commit();
            }

        }

        $con->close();
        return "Done $toc insertions";

    }



}