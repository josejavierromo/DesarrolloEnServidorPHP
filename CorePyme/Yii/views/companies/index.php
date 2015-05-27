<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorePyme\Security\Searchs\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">
    <?php
        echo $this->render('createModal', ['assistant' => false]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'tableOptions' => ['class' => 'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'header' => ''],

            'TradeName',
            'CorporateName',
            'CIF',
            'Notes',

            ['class' => 'yii\grid\ActionColumn',
             'buttons' => [
                            'view' => function ($url, $model, $key)
                                      {
                                        return $this->render('viewModal', ['model' => $model]);
                                      },
                            'update' => function($url, $model, $key)
                                        {
                                            return $this->render('updateModal', ['model' => $model]);
                                        }
                          ],
            ],
        ],
    ]); ?>

    <?= Html::a(Yii::t('app','Volver'),
                     ['/site/index'],
                     ['class' => 'btn btn-default']) ?>

</div>
