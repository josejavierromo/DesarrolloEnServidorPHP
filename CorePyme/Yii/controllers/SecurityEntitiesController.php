<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\Searchs\SecurityEntitiesSearch;


/**
 * SecurityEntitiesController implements the CRUD actions for SecurityEntities model.
 */
class SecurityEntitiesController extends CorePymeController
{

    public $layout = "main.php";

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
     * Lists all SecurityEntities models.
     * @return mixed
     */
    public function actionIndex($type)
    {
        if($this->isAuthenticate())
        {
            $searchModel = new SecurityEntitiesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'type' => $type,
            ]);
        }
    }

    /**
     * Displays a single SecurityEntities model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if($this->isAuthenticate())
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
    * Creates a new SecurityEntities model (user).
    * It's not validated and can not login 
    * @return mixed
    */
    public function actionRegister()
    {
        $this->layout = "login.php";
        $model = new SecurityEntities();

        if($model->load(Yii::$app->request->post()))
        {
            $model->Validated = 0;
            if($model->save())
            {
                return $this->redirect(['site/index']);
            }
            else{
                $this->render('register',[
                    'model' => $model]);
            }
        }
        else
        {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new SecurityEntities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if($this->isAuthenticate())
        {
            $model = new SecurityEntities();
            $model->Password = "0";

            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                return $this->redirect(['index','type' => $model->IdEntityType]);
            } else 
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing SecurityEntities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if($this->isAuthenticate())
        {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                return $this->redirect(['index','type' => $model->IdEntityType]);
            } else 
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing SecurityEntities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->isAuthenticate())
        {
            $model = $this->findModel($id);
            $type = $model->IdEntityType;
            $model->delete();

            return $this->redirect(['index','type' => $type]);
        }
    }

    /**
     * Finds the SecurityEntities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SecurityEntities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SecurityEntities::findOne($id)) !== null) 
        {
            return $model;
        } else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
