<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\SecurityEntityTypes;

$label = "";

switch($type)
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

Modal::begin([
            'toggleButton' => [
                                'label' => 'Nuevo '.$label,
                                'class' => 'btn btn-success',
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Crear '.$label),
            ]);

        $entity = new SecurityEntities();
        $entity->IdEntityType = $type;

        echo $this->render('create', [
            'model' => $entity,
            ]);
Modal::end();
?>