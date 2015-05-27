<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\OfficesSecurityEntities;


echo '<p>';
Modal::begin(['toggleButton' => [
                                'label' => Yii::t('app','Nuevo acceso'),
                                'class' => 'btn btn-success',
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger btn-sm pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Crear acceso'),
            ]);

        $access = new OfficesSecurityEntities();

        echo $this->render('create', [
            'model' => $access,
            ]);
Modal::end();
echo '</p>';
?>