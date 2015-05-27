<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\Searchs\OfficesSearch;
use app\models\CorePyme\Security\Companies;

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
            'header' => Yii::t('app','Modificar empresa'),
            ]);

        $searchModelUpdate = new OfficesSearch();
        $dataProviderUpdate = $searchModelUpdate->search($model->IdCompany);

        echo $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModelUpdate,
            'dataProvider' => $dataProviderUpdate,
            ]);
Modal::end();