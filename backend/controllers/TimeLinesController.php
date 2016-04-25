<?php

namespace backend\controllers;

use common\models\Tv;
use common\controllers\AuthController;
use Yii;
use common\models\TimeLine;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * TimeLinesController implements the CRUD actions for TimeLine model.
 */
class TimeLinesController extends AuthController
{
    /**
     * Lists all TimeLine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TimeLine::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimeLine model.
     * @param string $id
     * @param string $tv_id
     * @return mixed
     */
    public function actionView($id, $tv_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $tv_id),
        ]);
    }

    /**
     * Creates a new TimeLine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TimeLine();
        $data = [];
        $tvs = Tv::find()->all();
        foreach($tvs as $item){
            $data[$item->id] = $item->title;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved.');
            return $this->redirect(['view', 'id' => $model->id, 'tv_id' => $model->tv_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data' => $data,
            ]);
        }
    }

    /**
     * Updates an existing TimeLine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $tv_id
     * @return mixed
     */
    public function actionUpdate($id, $tv_id)
    {
        $model = $this->findModel($id, $tv_id);
        $data = [];
        $tvs = Tv::find()->all();
        foreach($tvs as $item){
            $data[$item->id] = $item->title;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Saved.');
            return $this->redirect(['view', 'id' => $model->id, 'tv_id' => $model->tv_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'data' => $data,
            ]);
        }
    }

    /**
     * Deletes an existing TimeLine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $tv_id
     * @return mixed
     */
    public function actionDelete($id, $tv_id)
    {
        $this->findModel($id, $tv_id)->delete();
        Yii::$app->session->setFlash('success', 'Deleted.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the TimeLine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $tv_id
     * @return TimeLine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $tv_id)
    {
        if (($model = TimeLine::findOne(['id' => $id, 'tv_id' => $tv_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
