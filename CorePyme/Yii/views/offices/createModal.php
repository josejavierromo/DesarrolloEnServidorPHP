<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\Offices;

Modal::begin([
            'toggleButton' => [
                                'label' => Yii::t('app','Nuevo centro'),
                                'class' => 'btn btn-success',
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Crear centro'),
            ]);

        $office = new Offices();
        $office->IdCompany = $company->IdCompany;

        echo $this->render('create', [
            'model' => $office,
            ]);
Modal::end();
?>