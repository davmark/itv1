<?php

namespace backend\controllers;

use common\models\Category;
use common\models\CategoryShow;
use common\models\Language;
use common\controllers\AuthController;
use common\models\LanguagesHasShows;
use common\models\Tv;
use Eventviva\ImageResize;
use Yii;
use common\models\Show;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use common\components\Translate;
use yii\web\UploadedFile;

/**
 * ShowsController implements the CRUD actions for Show model.
 */
class ShowsController extends AuthController
{
    /**
     * Lists all Show models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Show::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Show model.
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
     * Creates a new Show model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Show();
        $data = [];
        $value = [];
        $data_tvs=[];
        $modelCatshow = new CategoryShow();

        $categories = Category::find()->all();
        $upload = UploadedFile::getInstance($model,'path');
        $tvs = Tv::find()->all();

        $model_lang = new LanguagesHasShows();
        $lang = Language::find()->all();
        $post = Yii::$app->request->post();

        foreach($tvs as $item){
            $data_tvs[$item->id] = Translate::text($item->getLanguagesHasTvs(), 'title');
        }

        foreach($categories as $item){
            $data[$item->id] = Translate::text($item->getLanguagesHasCategories(), 'title');
        }

        if ($model->load($post) && $model->save()) {

            $cat_id = Yii::$app->request->post('cat_id');
            $modelCatshow->add($cat_id, $model->id);

            $model_lang->add($post, $lang, $model->id);

            if(!empty($upload)) {
                $this->fileUpload($model->id);
            }
            Yii::$app->session->setFlash('success', 'Saved.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data'   => $data,
                'value' => $value,
                'lang'  => $lang,
                'data_tvs' => $data_tvs,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Updates an existing Show model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $value = [];
        $data = [];
        $data_tvs = [];
        $model = $this->findModel($id);
        $modelCatshow = new CategoryShow();
        $modelHas = $this->findModelHas($id);
        $tvs = Tv::find()->all();
        $upload = UploadedFile::getInstance($model,'path');
        $model_lang = new LanguagesHasShows();
        $lang = Language::find()->all();
        $post = Yii::$app->request->post();

        foreach($tvs as $item){
            $data_tvs[$item->id] = Translate::text($item->getLanguagesHasTvs(), 'title');
        }

        $categories = Category::find()->all();

        foreach($categories as $item){
            $data[$item->id] =  Translate::text($item->getLanguagesHasCategories(), 'title');
        }

        foreach($modelHas as $item){
            $value[] = $item->category_id;
        }

        if(!empty($post)) {
            $post['Show']['path'] = $model->path;
        }

        if ($model->load($post) && $model->save()) {

            $cat_id = Yii::$app->request->post('cat_id');

            if(!empty($upload)) {
                $this->fileUpload($model->id);
            }

            $model_lang->remove($model->id);
            $model_lang->add($post, $lang, $model->id);

            $modelCatshow->remove($model->id);
            $modelCatshow->add($cat_id, $model->id);
            Yii::$app->session->setFlash('success', 'Saved.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'data'   => $data,
                'value' => $value,
                'lang'  => $lang,
                'data_tvs' => $data_tvs,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Deletes an existing Show model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Deleted.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Show model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Show the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Show::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelHas($id)
    {
        if (($model = CategoryShow::find()->where(['show_id' => $id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function fileUpload($id){

        $path = Yii::getAlias("@frontend/web/uploads/shows");
        BaseFileHelper::createDirectory($path);

        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model,'path');

        $symbols = '0123456789abcdefghijklmnopqrstuvwxyz';
        $filename = substr(str_shuffle($symbols), 0, 16);

        $name = $filename.".".$file->extension;
        $file->saveAs($path .DIRECTORY_SEPARATOR .$name);

        $image  = $path .DIRECTORY_SEPARATOR .$name;
        $new_name = $path .DIRECTORY_SEPARATOR."small_279-155_".$name;

        $model->path = $name;
        $model->save();

        $image = new ImageResize($image);
        $image->resizeToBestFit(279, 155);
        $image->crop(279, 155);
        $image->save($new_name, IMAGETYPE_JPEG, 100);

    }
}
