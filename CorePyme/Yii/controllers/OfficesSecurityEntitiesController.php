<?php

namespace app\controllers;

use Yii;
use app\models\CorePyme\Security\OfficesSecurityEntities;
use app\models\CorePyme\Security\Searchs\OfficesSecurityEntitiesSearch;
use app\models\CorePyme\Log\Sessions;
use app\controllers\CorePymeController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfficesSecurityEntitiesController implements the CRUD actions for OfficesSecurityEntities model.
 */
class OfficesSecurityEntitiesController extends CorePymeController
{

    public $layout = "login.php";

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
    * Display the initial page of this module
    *
    * @return mixed
    */
    public function actionIndex()
    {        
        if($this->isAuthenticate())
        {
            $this->layout = "main.php";
            $searchModel = new OfficesSecurityEntitiesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);
        }
    }

    /**
    * Display a form for create and save a new record
    *
    * @return mixed
    */
    public function actionCreate()
    {
        if($this->isAuthenticate())
        {
            $this->layout = "main.php";
            $model = new OfficesSecurityEntities();
            $model->Since = date('Y-m-d H:i:s');

            if($model->load(Yii::$app->request->post()))
            {

                if(OfficesSecurityEntities::getOfficesEntity($model->IdOffice, $model->IdSecurityEntity) == null)
                {
                    $model->save();
                }
                return $this->redirect(['index']);
            }
            else
            {
                return $this->render('create', [
                        'model' => $model,
                    ]);
            }
        }
    }

    /**
    * Removes the entity object specified
    *
    * @param integer $id
    *   Identifier record to be searched
    * @return mixed
    */
    public function actionDelete($id)
    {
        if($this->isAuthenticate())
        {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
    }

    /**
     * Lists all OfficesSecurityEntities models.
     * @return mixed
     */
    public function actionSelect()
    {
        if($this->isAuthenticate())
        {
            $this->layout = "login.php";
            $searchModel = new OfficesSecurityEntitiesSearch();
            $dataProvider = $searchModel->searchOfficesUser(Yii::$app->request->queryParams);

            return $this->render('select', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionSelection($id)
    {
        if($this->isAuthenticate())
        {
            Sessions::updateOfficeSession($id);
            return $this->redirect(['site/index']);            
        }
    }

    /**
     * Finds the OfficesSecurityEntities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OfficesSecurityEntities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OfficesSecurityEntities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
