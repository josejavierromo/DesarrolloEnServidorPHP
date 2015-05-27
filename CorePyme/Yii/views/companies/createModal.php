<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\CorePyme\Security\Searchs\OfficesSearch;
use app\models\CorePyme\Security\Companies;
echo '<p>';
Modal::begin(['toggleButton' => [
                                'label' => Yii::t('app','Nueva empresa'),
                                'class' => 'btn btn-success',
                                ],
            'closeButton' => [
                                'label' => Yii::t('app','Cerrar'),
                                'class' => 'btn btn-danger btn-sm pull-right',
                             ],
            'size' => 'modal-lg',
            'header' => Yii::t('app','Crear empresa'),
            ]);

        $searchModelCreate = new OfficesSearch();
        $dataProviderCreate = $searchModelCreate->search(-999);
        $company = new Companies();

        echo $this->render('create', [
            'model' => $company,
            'searchModel' => $searchModelCreate,
            'dataProvider' => $dataProviderCreate,
            ]);
Modal::end();
echo '</p>';
?>