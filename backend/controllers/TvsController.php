<?php

namespace backend\controllers;

use common\models\Country;
use common\models\Language;
use common\components\Translate;
use common\controllers\AuthController;
use common\models\LanguagesHasTvs;
use Eventviva\ImageResize;


use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Yii;
use common\models\Tv;

use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


/**
 * TvsController implements the CRUD actions for Tv model.
 */
class TvsController extends AuthController
{

    /**
     * Lists all Tv models.
     * @return mixed
     */
    public function actionIndex()
    {

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => '/opt/ffmpeg/bin/ffmpeg',
            'ffprobe.binaries' => '/opt/ffmpeg/bin/ffprobe'
        ]);

        //var_dump($ffmpeg); die;

 //       $ffmpeg = FFMpeg::create();

        $video = $ffmpeg->open('http://a.autogsv.ru/js/aliez.mp4');


//        $video
//            ->filters()
//            ->resize(new Dimension(320, 240))
//            ->synchronize();
//
//        $video->filters()->clip(TimeCode::fromSeconds(0), TimeCode::fromSeconds(10));

       $video
            ->frame(TimeCode::fromSeconds(25));
            //->save(Yii::getAlias("@backend/web/video/nor". time() . '.jpg'));
//        $video
   //        ->save(new X264(), './video/' . time() . '.mp4');
//            ->save(new WMV(), './video/nor' . time() . '.wmv');
  //          ->save(new WebM(), './video/' . time() . '.webm');


        $dataProvider = new ActiveDataProvider([
            'query' => Tv::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tv model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id, $country_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $country_id),
        ]);
    }

    /**
     * Creates a new Tv model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Tv();
        $model_lang = new LanguagesHasTvs();
        $post = Yii::$app->request->post();
        $lang = Language::find()->all();
        $upload = UploadedFile::getInstance($model,'path');

        $data = [];
        $countries = Country::find()->all();

        foreach($countries as $item){
            $data[$item->id] = Translate::text($item->getLanguagesHasCountries(), 'title');
        }



        if ($model->load($post) && $model->save()) {

            $model_lang->add($post, $lang, $model->id);
            Yii::$app->session->setFlash('success', 'Saved.');
            if(!empty($upload)) {
                $this->fileUpload($model->id, $model->country_id);
            }
            return $this->redirect(['view', 'id' => $model->id, 'country_id' => $model->country_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'lang'  => $lang,
                'data'  =>  $data,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Updates an existing Tv model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id, $country_id)
    {
        $model = $this->findModel($id, $country_id);
        $model_lang = new LanguagesHasTvs();
        $post = Yii::$app->request->post();
        $lang = Language::find()->all();

        $upload = UploadedFile::getInstance($model,'path');
        if(!empty($post)) {
            $post['Tv']['path'] = $model->path;
        }

        $data = [];
        $countries = Country::find()->all();
        foreach($countries as $item){
            $data[$item->id] = Translate::text($item->getLanguagesHasCountries(), 'title');
        }

        if ($model->load($post) && $model->save()) {

            $model_lang->remove($model->id);
            $model_lang->add($post, $lang, $model->id);

            Yii::$app->session->setFlash('success', 'Saved.');
            if(!empty($upload)) {
                $this->fileUpload($model->id, $model->country_id);
            }

            return $this->redirect(['view', 'id' => $model->id, 'country_id' => $model->country_id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'lang'  => $lang,
                'data'  =>  $data,
                'model_lang' => $model_lang,
            ]);
        }
    }
    /**
     * Deletes an existing Tv model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $country_id
     * @return mixed
     */
    public function actionDelete($id, $country_id)
    {
        $this->findModel($id, $country_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tv model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $country_id
     * @return Tv the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $country_id)
    {
        if (($model = Tv::findOne(['id' => $id, 'country_id' => $country_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function fileUpload($id, $country_id){

        $path = Yii::getAlias("@frontend/web/uploads/tvs");
        BaseFileHelper::createDirectory($path);

        $model = $this->findModel($id, $country_id);
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
