<?php

namespace backend\controllers;

use common\controllers\AuthController;
use Eventviva\ImageResize;
use Yii;
use common\models\Banner;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * BannersController implements the CRUD actions for Banner model.
 */

class BannersController extends AuthController
{

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banner::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        $upload = UploadedFile::getInstance($model,'path');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved.');

            if(!empty($upload)) {
                $this->fileUpload($model->id);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $upload = UploadedFile::getInstance($model,'path');

        $post = Yii::$app->request->post();
        if(!empty($post)) {
            $post['Banner']['path'] = $model->path;
        }

        if ($model->load($post) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved.');

            if(!empty($upload)) {
                $this->fileUpload($model->id);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function fileUpload($id){

        $path = Yii::getAlias("@frontend/web/uploads/banners");
        BaseFileHelper::createDirectory($path);

        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model,'path');

        $symbols = '0123456789abcdefghijklmnopqrstuvwxyz';
        $filename = substr(str_shuffle($symbols), 0, 16);

        $name = $filename.".".$file->extension;
        $file->saveAs($path .DIRECTORY_SEPARATOR .$name);

        $image  = $path .DIRECTORY_SEPARATOR .$name;
        $new_name = $path .DIRECTORY_SEPARATOR."small_700-100_".$name;

        $model->path = $name;
        $model->save();

        $image = new ImageResize($image);
        $image->resizeToBestFit(700, 100);
        $image->crop(700, 100);
        $image->save($new_name, IMAGETYPE_JPEG, 100);

    }
}
