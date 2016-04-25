<?php

namespace backend\controllers;

use common\controllers\AuthController;
use common\models\Language;
use common\models\LanguagesHasCountries;
use Yii;
use common\models\Country;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * CountriesController implements the CRUD actions for Country model.
 */
class CountriesController extends AuthController
{
    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Country::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Country model.
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
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Country();
        $model_lang = new LanguagesHasCountries();
        $post = Yii::$app->request->post();
        $lang = Language::find()->all();


        if ($model->load($post) && $model->save()) {
            $model_lang->add($post, $lang, $model->id);
            
            Yii::$app->session->setFlash('success', 'Saved.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_lang = new LanguagesHasCountries();
        $lang = Language::find()->all();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {

            $model_lang->remove($model->id);
            $model_lang->add($post, $lang, $model->id);
            Yii::$app->session->setFlash('success', 'Saved.');
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]);
        }
    }

    /**
     * Deletes an existing Country model.
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
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
