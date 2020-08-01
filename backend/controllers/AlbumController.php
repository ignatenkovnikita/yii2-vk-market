<?php

namespace ignatenkovnikita\vkmarket\backend\controllers;

use ignatenkovnikita\vkmarket\backend\models\search\AlbumSearch;
use ignatenkovnikita\vkmarket\models\VkmarketAlbum;
use ignatenkovnikita\vkmarket\services\Vk;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AlbumController implements the CRUD actions for VkmarketAlbum model.
 */
class AlbumController extends Controller
{
    /** @var Vk $vkService */
    private $vkService;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function __construct($id, $module, $config = [])
    {

        $this->vkService = new Vk();

        parent::__construct($id, $module, $config);
    }

    /**
     * Lists all VkmarketAlbum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VkmarketAlbum model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VkmarketAlbum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelProduct = Yii::createObject(Yii::$app->getModule('vkmarket')->product);

        $model = new VkmarketAlbum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $path = Yii::getAlias('@storage/web/source' . DIRECTORY_SEPARATOR . $model->vkmarketAttachment->path);
            $itemId = $this->vkService->addAlbum($model->title, $model->main_album, $path);

            $model->vk_id = $itemId;
            $model->update(['vk_id']);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VkmarketAlbum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $a = [1];
        $b = [1, 2];

        $output = array_map(function ($a, $b) {
            return $a - $b;
        }, $b, $a);

        $modelProduct = Yii::createObject(Yii::$app->getModule('vkmarket')->product);


        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $path = Yii::getAlias('@storage/web/source' . DIRECTORY_SEPARATOR . $model->vkmarketAttachment->path);

            if($model->vk_id){
            $itemId = $this->vkService->editAlbum($model->vk_id, $model->title, $model->main_album, $path);
            }else{
            $itemId = $this->vkService->addAlbum( $model->title, $model->main_album, $path);
                $model->vk_id = $itemId;
                $model->update(['vk_id']);
            }

            $old = \yii\helpers\ArrayHelper::getColumn($model->oldProducts, 'id');

            $diffAdd = [];
            $diffRemove = [];
            if ($model->product_ids) {
                $diffAdd = array_diff($model->product_ids, $old);
                $diffRemove = array_diff($old, $model->product_ids);
            } else {
                $diffRemove = $old;
            }

            foreach ($modelProduct::find()->andWhere(['id' => $diffAdd])->select(['vk_id'])->each() as $product) {
                $this->vkService->addProductToAlbum($model->vk_id, $product->vk_id);
            }
            foreach ($modelProduct::find()->andWhere(['id' => $diffRemove])->select(['vk_id'])->each() as $product) {
                $this->vkService->removeFromAlbum($model->vk_id, $product->vk_id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VkmarketAlbum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->vkService->deleteAlbum($model->vk_id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VkmarketAlbum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VkmarketAlbum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VkmarketAlbum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
