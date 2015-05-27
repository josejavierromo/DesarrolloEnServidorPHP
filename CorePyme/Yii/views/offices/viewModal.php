<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin(['toggleButton' => [
								'tag' => 'a',
                                'label' => '<span class="glyphicon glyphicon-eye-open"/>',
                                'title' => Yii::t('app','Ver'),
                                'data-pjax' => 0,
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger btn-sm pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Ver información del centro'),
            ]);

        echo $this->render('view', [
            'model' => $model,
            ]);
Modal::end();