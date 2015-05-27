<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Companies */

echo $this->render('_form', [
        'model' => $model,
        'assistant' => false,
        'readonly' => false,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'coreAction' => 'update',
    ]);

?>


