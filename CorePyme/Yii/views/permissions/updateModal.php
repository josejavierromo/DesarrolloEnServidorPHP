<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

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
            'header' => Yii::t('app','Modificar permiso'),
            ]);

        echo $this->render('update', [
            'model' => $model,
            ]);
Modal::end();