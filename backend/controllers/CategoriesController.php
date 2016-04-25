<?php

namespace backend\controllers;

use common\models\CategoriesTvs;
use common\models\Language;
use common\models\LanguagesHasCategories;
use common\models\Tv;
use common\controllers\AuthController;
use Eventviva\ImageResize;
use Yii;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use common\components\Translate;
use yii\web\UploadedFile;

/**
 * CategoriesController implements the CRUD actions for Category model.
 */
class CategoriesController extends AuthController
{
    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = [];
        $value = [];
        $model = new Category();
        $upload = UploadedFile::getInstance($model,'path');
        $modelCatTV = new CategoriesTvs();
        $model_lang = new LanguagesHasCategories();
        $lang = Language::find()->all();
        $post = Yii::$app->request->post();
        $tvs = Tv::find()->all();

        foreach($tvs as $item){
            $data[$item->id] = Translate::text($item->getLanguagesHasTvs(), 'title');
        }

        if ($model->load($post) && $model->save()) {

            $tv_id = Yii::$app->request->post('tv_id');
            $modelCatTV->add($tv_id, $model->id);

            $model_lang->add($post, $lang, $model->id);

            Yii::$app->session->setFlash('success', 'Saved.');

            if(!empty($upload)) {
                $this->fileUpload($model->id);
            }

            return $this->redirect(['view', 'id' => $model->id, 'modelCatTV' => $modelCatTV]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data'   => $data,
                'value' => $value,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $value = [];
        $data = [];
        $model = $this->findModel($id);
        $upload = UploadedFile::getInstance($model,'path');
        $model_lang = new LanguagesHasCategories();
        $lang = Language::find()->all();
        $post = Yii::$app->request->post();
        $modelCatTV = new CategoriesTvs();
        $modelHas = $this->findModelHas($id);

        $tvs = Tv::find()->all();

        foreach($tvs as $item){
            $data[$item->id] =  Translate::text($item->getLanguagesHasTvs(), 'title');
        }

        foreach($modelHas as $item){
            $value[] = $item->tv_id;
        }


        if ($model->load($post) && $model->save()) {
            $tv_id = Yii::$app->request->post('tv_id');

            $modelCatTV->remove($model->id);
            $modelCatTV->add($tv_id, $model->id);

            $model_lang->remove($model->id);
            $model_lang->add($post, $lang, $model->id);
            Yii::$app->session->setFlash('success', 'Saved.');

            if(!empty($upload)) {
                $this->fileUpload($model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'data'   => $data,
                'value' => $value,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelHas($id)
    {

        if (($model = CategoriesTvs::find()->where(['category_id' => $id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function fileUpload($id){

        $path = Yii::getAlias("@frontend/web/uploads/categories");
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