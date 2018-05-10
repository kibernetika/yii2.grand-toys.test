<?php

namespace app\controllers;

use Yii;
use app\models\Goods;
use app\models\GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends BaseAdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imageName = time();
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $model->file->saveAs('uploads/goods_'.$imageName.'.'.$model->file->extension);
                $model->photo = 'uploads/goods_'.$imageName.'.'.$model->file->extension;
                $model->save();
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $this->layout = 'main_modal';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imageName = time();
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $model->file->saveAs('uploads/goods_'.$imageName.'.'.$model->file->extension);
                $model->photo = 'uploads/goods_'.$imageName.'.'.$model->file->extension;
                $model->save();
            }
            return $this->redirect(['goods/index', 'id_goods' => $model->id_goods]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteimage($id)
    {
        $model = $this->findModel($id);
        $imgName = $model->photo;
        unlink(Yii::getAlias('').$imgName);
        $model->photo = null;
        $model->update();
        if (Yii::$app->request->isAjax)
        {
            return 'Deleted';
        } else {
            return $this->redirect(['update', 'id' => $model->id_goods]);
        }
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
