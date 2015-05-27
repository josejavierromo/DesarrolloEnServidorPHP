<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Companies */

//echo '<div id="pnlDefault" class="site-login panel panel-default col-xs-3 col-sm-3 col-md-3 col-lg-3">';
//echo '<div class="panel-heading">';
//echo '<h4>'.Html::encode($this->title).'</h4>';
//echo '</div>';

echo $this->render('_form', [
        'model' => $model,
        'assistant' => false,
        'readonly' => false,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'coreAction' => 'create',
    ]);
//echo '</div>';


