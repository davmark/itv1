<?php

namespace backend\controllers;

use common\components\Translate;
use common\controllers\AuthController;
use common\models\Show;
use Eventviva\ImageResize;
use Yii;
use common\models\Program;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


/**
 * ProgramsController implements the CRUD actions for Program model.
 */
class ProgramsController extends AuthController
{
    /**
     * Lists all Program models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Program::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Program model.
     * @param string $id
     * @param string $shows_id
     * @return mixed
     */
    public function actionView($id, $shows_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $shows_id),
        ]);
    }

    /**
     * Creates a new Program model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Program();
        $data_shows = [];
        $shows =  Show::find()->all();

        $upload = UploadedFile::getInstance($model,'path');

        foreach($shows as $item){
            $data_shows[$item->id] = Translate::text($item->getLanguagesHasShows(), 'title');
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved.');

            if(!empty($upload)) {
                $this->fileUpload($model->id, $model->shows_id);
            }
            return $this->redirect(['view', 'id' => $model->id, 'shows_id' => $model->shows_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'shows' => $data_shows,
            ]);
        }
    }

    /**
     * Updates an existing Program model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $shows_id
     * @return mixed
     */
    public function actionUpdate($id, $shows_id)
    {
        $model = $this->findModel($id, $shows_id);

        $data_shows = [];
        $shows =  Show::find()->all();

        $upload = UploadedFile::getInstance($model,'path');

        $post = Yii::$app->request->post();

        if($post) {
            $post['Program']['path'] = $model->path;
        }

        foreach($shows as $item){
            $data_shows[$item->id] = Translate::text($item->getLanguagesHasShows(), 'title');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved.');

            if(!empty($upload)) {
                $this->fileUpload($model->id, $model->shows_id);
            }

            return $this->redirect(['view', 'id' => $model->id, 'shows_id' => $model->shows_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'shows' => $data_shows,
            ]);
        }
    }

    /**
     * Deletes an existing Program model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $shows_id
     * @return mixed
     */
    public function actionDelete($id, $shows_id)
    {
        $this->findModel($id, $shows_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Program model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $shows_id
     * @return Program the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $shows_id)
    {
        if (($model = Program::findOne(['id' => $id, 'shows_id' => $shows_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function fileUpload($id, $shows_id){

        $path = Yii::getAlias("@frontend/web/uploads/programs");
        BaseFileHelper::createDirectory($path);

        $model = $this->findModel($id, $shows_id);
        $file = UploadedFile::getInstance($model,'path');

        $symbols = '0123456789abcdefghijklmnopqrstuvwxyz';
        $filename = substr(str_shuffle($symbols), 0, 16);

        $name = $filename.".".$file->extension;
        $file->saveAs($path .DIRECTORY_SEPARATOR .$name);

        $image  = $path .DIRECTORY_SEPARATOR .$name;
        $new_name = $path .DIRECTORY_SEPARATOR."small_120-90_".$name;

        $model->path = $name;
        $model->save();

        $image = new ImageResize($image);
        $image->resizeToBestFit(108, 60);
        $image->crop(108, 61);
        $image->save($new_name, IMAGETYPE_JPEG, 100);

        $new_name2 = $path .DIRECTORY_SEPARATOR."small_320-180_".$name;
        $image->resizeToBestFit(320, 180);
        $image->crop(320, 180);
        $image->save($new_name2, IMAGETYPE_JPEG, 100);

    }
}
