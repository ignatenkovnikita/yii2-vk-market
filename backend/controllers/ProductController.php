<?php


namespace ignatenkovnikita\vkmarket\backend\controllers;


use yii\web\Controller;

class ProductController extends Controller
{

    public function actionList($q = null, $id = null)
    {
        $modelProduct = \Yii::createObject(\Yii::$app->getModule('vkmarket')->product);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $productQuery = $modelProduct::find()->withText($q)->withVkId();
            $r = [];
            foreach ($productQuery->each() as $product) {
                /** @var Product $product */
                $r[] = ['id' => $product->id, 'text' => $product->titleForVkMarketSelect];
            }

            $out['results'] = $r;
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => $modelProduct::findOne($id)->titleForVkMarketSelect];
        }
        return $out;
    }

}