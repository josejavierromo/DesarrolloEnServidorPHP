<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\SecurityEntityTypes;


Modal::begin([
            'toggleButton' => [
                                'label' => Yii::t('app','Registrarse'),
                                'class' => 'btn btn-success',
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Registro'),
            ]);

        $entity = new SecurityEntities();
        $entity->IdEntityType = SecurityEntityTypes::user;

        echo $this->render('register', [
            'model' => $entity,
            ]);
Modal::end();
?>