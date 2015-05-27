<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorePyme\Security\Searchs\OfficesSecurityEntitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seleccionar un centro');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="modal-body">
            <?php 
            echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}{pager}',
                    'columns' => [
                        [
                         'label' => Yii::t('app','Seleccionar'),
                         'format' => 'raw',
                         'value' => function($data)
                                    {
                                        return Html::a(Yii::t('app','Entrar'),
                                                       [
                                                        'selection','id' => $data->IdOffice
                                                       ],
                                                       ['class' => 'btn btn-success']);
                                    },
                        ],
                        [
                            'attribute' => 'IdOffice',
                            'label' => Yii::t('app','Centro'),
                            'value' => 'office.OffcieTradeName',
                        ],
                        'Since',
                    ],
                ]);
            ?>
        </div>
    </div>
</div>
