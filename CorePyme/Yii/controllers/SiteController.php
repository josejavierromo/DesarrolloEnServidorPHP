<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CorePyme\Security\Offices;
use app\models\CorePyme\Security\OfficesSecurityEntities;
use app\models\CorePyme\Security\Devices;
use app\models\CorePyme\Security\DeviceTypes;
use app\models\CorePyme\Log\Sessions;

class SiteController extends Controller
{
    public $layout = "login.php";
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) 
            {
                return $this->createAccess();
            }
            else 
            {
                return $this->renderLogin($model);
            }
        }
        else
        {
            return $this->createAccess();
        }

    }

    public function actionLogout()
    {
        Sessions::closeSession();
        return $this->redirect(['index']);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    /**
    * Renderiza el formulario de acceso de usuarios
    */
    private function renderLogin($model)
    {
        return $this->render('login', [
            'model' => $model,
        ]);        
    }

    /**
    * Rellena la información de centro, módulos y permisos de la sessión actual, además de redireccionar a la acción correspondiente, dependiendo
    * de si hay registrado algún centro o no.
    */
    private function createAccess()
    {
        try
        {
            $offices = Offices::getAllOffices();
            switch($offices->count())
            {
                case 0:
                    return $this->redirect(['companies/welcome']);
                default:
                    $this->layout = "main.php";
                    $offices = OfficesSecurityEntities::getOffices(Yii::$app->user->identity->IdSecurityEntity);
                    switch($offices->count())
                    {
                        case 0:
                            $this->layout = "login.php";
                            return $this->render('nologin');
                        case 1:
                            Sessions::updateOfficeSession($offices->one()->IdOffice);
                            return $this->render('main');
                        default:
                            $offices = Sessions::getSession(Yii::$app->session->getId());
                            if($offices->IdOffice == '0000-0000')
                            {
                                return $this->redirect(['offices-security-entities/select']);
                            }
                            else
                            {
                                Sessions::updateOfficeSession($offices->IdOffice);
                                return $this->render('main');
                            }
                    }
            }
        }
        finally{
            $this->layout = "login.php";
        }
    }
}
