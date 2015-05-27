<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\Searchs\OfficesSearch;
use app\models\CorePyme\Security\Companies;

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
            'header' => Yii::t('app','Ver información empresa'),
            ]);

        $searchModelView = new OfficesSearch();
        $dataProviderView = $searchModelView->search($model->IdCompany);

        echo $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModelView,
            'dataProvider' => $dataProviderView,
            ]);
Modal::end();