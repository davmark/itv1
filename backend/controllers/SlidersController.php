<?php

namespace backend\controllers;

use common\controllers\AuthController;
use Eventviva\ImageResize;
use Yii;
use common\models\Slider;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * SlidersController implements the CRUD actions for Slider model.
 */

class SlidersController extends AuthController
{

    /**
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slider::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slider model.
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
     * Creates a new Slider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider();

        $post = Yii::$app->request->post();

        if ($model->load() && $model->save()) {
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
     * Updates an existing Slider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $upload = UploadedFile::getInstance($model,'image');

        $post = Yii::$app->request->post();
        if(!empty($post)) {
            $post['Slider']['image'] = $model->image;
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
     * Deletes an existing Slider model.
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
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function fileUpload($id){

        $image = Yii::getAlias("@frontend/web/uploads/sliders/".$id);
        BaseFileHelper::createDirectory($image);

        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model,'image');

        $name = "slider.".$file->extension;
        $file->saveAs($image .DIRECTORY_SEPARATOR .$name);

        $model->image = $name;
        $model->save();
    }
}
