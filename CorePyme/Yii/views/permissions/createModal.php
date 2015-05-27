<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\Permissions;

Modal::begin([
            'toggleButton' => [
                                'label' => Yii::t('app','Nuevo permiso'),
                                'class' => 'btn btn-success',
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Crear permiso'),
            ]);

        $permission = new Permissions();

        echo $this->render('create', [
            'model' => $permission,
            ]);
Modal::end();
?>