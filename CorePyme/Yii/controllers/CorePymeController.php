<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class CorePymeController extends Controller
{
	/**
	* Check if user is authenticated, if not is authenticate redirect to login page
	*/
	protected function isAuthenticate()
	{
		if(Yii::$app->user->isGuest)
		{
			$this->redirect(Url::toRoute('site/index'));
			return false;
		}

		return true;
	}
}

