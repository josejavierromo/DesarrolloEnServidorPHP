<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\base\ErrorException;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\validators\ImageValidator;
use app\models\CorePyme\Security\Companies;
use app\models\CorePyme\Security\Searchs\CompaniesSearch;
use app\models\CorePyme\Security\Searchs\OfficesSearch;


/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends CorePymeController
{

    public $layout = "main.php";

    protected $assistant = false;
    protected $readonly = false;
    protected $coreAction = "";

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
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        if($this->isAuthenticate())
        {
            $searchModel = new CompaniesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Companies model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if($this->isAuthenticate())
        {
            $searchModel = new OfficesSearch();
            $dataProvider = $searchModel->search($id);

            return $this->render('view', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $image = null;
        $logo = "";
        if($this->isAuthenticate())
        {
            $model = new Companies();

            if ($model->load(Yii::$app->request->post())) {
                $logo = $model->Logo;
                $image = UploadedFile::getInstance($model,'Logo');

                if($image == null)
                {
                    $model->Logo = $logo;
                }
                else
                {
                    $model->Logo = $image;
                }

                if($model->save())
                {
                    if($image !== null)
                    {
                        $model->Logo->saveAs('img/'.$model->Logo->baseName.'.'.$model->Logo->extension);
                    }
                }
            } 

            return $this->redirect(['companies/index']);
        }
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $image = null;
        $logo = "";
        if($this->isAuthenticate())
        {
            $model = $this->findModel($id);
            $logo = $model->Logo;

            if ($model->load(Yii::$app->request->post())) 
            {

                $image = UploadedFile::getInstance($model,'Logo');

                if($image == null)
                {
                    $model->Logo = $logo;
                }
                else
                {
                    $model->Logo = $image;
                }

                if($model->save(false))
                {
                    if($image !== null)
                    {
                        $image->saveAs('img/'.$image->baseName.'.'.$image->extension);
                    }
                }
            } 

            return $this->redirect(['companies/index']);
        }
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
    * Show the assistant for create companies and offices. This assistant will be open when there are not registered offices
    * 
    * @return mixed
    */
    public function actionAssistant()
    {
        if($this->isAuthenticate())
        {
            if(Companies::getCompanies()->count() == 0)
            {
                $model = new Companies();
                if ($model->load(Yii::$app->request->post()) && $model->save()) 
                {
                    return $this->redirect(['offices/assistant', 'idCompany' => $model->IdCompany]);
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
                $model = new Companies();
                if($model->load(Yii::$app->request->post()) && (Companies::getCompanies($model->CIF) !== null))
                {
                    $model = Companies::getCompanies($model->CIF)->one();
                    $model->load(Yii::$app->request->post());
                    $model->save(false);
                    return $this->redirect(['offices/assistant', 'idCompany' => $model->IdCompany]);
                }
                else
                {
                    $model = Companies::getCompanies()->all()[0];
                    return $this->render('assistant', [
                                    'model' => $model,
                                    ]);
                }
            }
        }
    }

    /**
    * Display initial message. It's link to welcome assitant
    *
    */
    public function actionWelcome()
    {
        if($this->isAuthenticate())
        {
            return $this->render('welcome');
        }
    }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
