<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\SecurityEntityTypes;

$label = "";

switch($model->IdEntityType)
{
    case SecurityEntityTypes::user:
        $label = Yii::t('app','usuario');
        break;
    case SecurityEntityTypes::group:
        $label = Yii::t('app','grupo');
        break;
    case SecurityEntityTypes::role:
        $label = Yii::t('app','rol');
        break;
    default:
        $label = Yii::t('app','usuario');
        break;                  
}

Modal::begin(['toggleButton' => [
                                'tag' => 'a',
                                'label' => '<span class="glyphicon glyphicon-pencil"/>',
                                'title' => Yii::t('app','Modificar'),
                                'data-pjax' => 0,
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger btn-sm pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Modificar '.$label),
            ]);

        echo $this->render('update', [
            'model' => $model,
            ]);
Modal::end();