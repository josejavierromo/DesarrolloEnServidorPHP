<?php

namespace app\controllers;

use Yii;
use app\models\Eventos;
use app\models\EventosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * EventosController implements the CRUD actions for Eventos model.
 */
class EventosController extends Controller
{
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

    /**
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(\Yii::$app->user->isGuest)
		{
			return $this->redirect('index.php?r=usuarios%2Flogin');
		}
		else
		{	
			$searchModel = new EventosSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
    }

    /**
     * Displays a single Eventos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(\Yii::$app->user->isGuest)
		{
			return $this->redirect('index.php?r=usuarios%2Flogin');
		}
		else
		{	
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}
    }

    /**
     * Creates a new Eventos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(\Yii::$app->user->isGuest)
		{
			return $this->redirect('index.php?r=usuarios%2Flogin');
		}
		else
		{	
			$model = new Eventos();
	
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->Codigo_evento]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}
    }

    /**
     * Updates an existing Eventos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(\Yii::$app->user->enableSession)
		{
			return $this->redirect('index.php?r=usuarios%2Flogin');
		}
		else
		{	
			$model = $this->findModel($id);
	
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->Codigo_evento]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
    }

    /**
     * Deletes an existing Eventos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(\Yii::$app->user->isGuest)
		{
			return $this->redirect('index.php?r=usuarios%2Flogin');
		}
		else
		{	
			$this->findModel($id)->delete();
	
			return $this->redirect(['index']);
		}
    }

    /**
     * Finds the Eventos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Eventos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
