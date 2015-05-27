<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use app\models\CorePyme\Security\Offices;
use app\models\CorePyme\Security\Searchs\OfficesSearch;
use app\models\CorePyme\Security\Companies;
use app\models\CorePyme\Security\OfficesSecurityEntities;


/**
 * OfficesController implements the CRUD actions for Offices model.
 */
class OfficesController extends CorePymeController
{

    public $layout = "main.php";

    public $assistant = false;
    public $idCompany = -999;
    //public $coreAction = "";

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
     * Lists all Offices models.
     * @return mixed
     */
    public function actionIndex($idCompany)
    {
        if($this->isAuthenticate())
        {
            $this->idCompany = $idCompany;
            
            $searchModel = new OfficesSearch();
            $dataProvider = $searchModel->search($idCompany);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Offices model.
     * @param string $id
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
    * Display the second step of the welcome assistant
    * 
    * @return mixed
    */
    public function actionAssistant($idCompany)
    {
        if($this->isAuthenticate())
        {
            $company = Companies::getCompany($idCompany);

            if(count($company->offices) == 0)
            {
                $model = new Offices();
                $model->IdCompany = $idCompany;                
            }
            else
            {
                $model = $company->offices[0];
            }

            if ($model->load(Yii::$app->request->post())) 
            {
                if($model->save(false))
                {
                    if(OfficesSecurityEntities::getPermission($model->IdOffice, Yii::$app->user->identity->IdSecurityEntity) == null)
                    {
                        $permission = new OfficesSecurityEntities();
                        $permission->IdOffice = $model->IdOffice;
                        $permission->IdSecurityEntity = Yii::$app->user->identity->IdSecurityEntity;
                        $permission->Since = date('Y-m-d H:i:s');
                        $permission->save();
                    }
                    return $this->redirect(['site/index']);
                }
                else
                {
                    return $this->render('assistant', [
                            'model' => $model,
                        ]);                    
                }
            } 
            else
            {
                return $this->render('assistant', [
                        'model' => $model,
                    ]);
            }
        }
    }

    /**
     * Creates a new Offices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $idCompany
     *      Id Company parent of the new office
     * @return mixed
     */
    public function actionCreate()
    {
        if($this->isAuthenticate())
        {
            $model = new Offices();

            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                $permission = new OfficesSecurityEntities();
                $permission->IdOffice = $model->IdOffice;
                $permission->IdSecurityEntity = Yii::$app->user->identity->IdSecurityEntity;
                $permission->Since = date('Y-m-d H:i:s');
                $permission->save();
                return $this->redirect(['companies/index']);
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
    * Display the modal form for create an office
    *
    * @return @mixed
    */
    public function actionCreateModal()
    {
        if($this->isAuthenticate())
        {
            $model = new Offices();
            return $this->renderPartial('createModal',[
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Offices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if($this->isAuthenticate())
        {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
                return $this->redirect(['companies/index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Offices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->isAuthenticate())
        {
            $this->findModel($id)->delete();

            return $this->redirect(['companies/index']);
        }
    }

    /**
     * Finds the Offices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Offices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
