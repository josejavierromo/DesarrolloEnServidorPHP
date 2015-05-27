<?php

use yii\helpers\Html;

echo $this->render('_form', [
        'model' => $model,
        'readonly' => false,
        'coreAction' => 'register'
    ]);
?>
