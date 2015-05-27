<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Offices */

echo $this->render('_form', [
        'model' => $model,
        'assistant' => false,
        'readonly' => false,
        'coreAction' => 'create',
    ]);
?>


