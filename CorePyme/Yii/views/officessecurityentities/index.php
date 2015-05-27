<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorePyme\Security\Searchs\OfficesSecurityEntitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acceso a centros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offices-security-entities-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo $this->render('createModal'); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'columns' => [
            [
                'attribute' => 'IdOffice',
                'label' => Yii::t('app','Centro'),
                'value' => 'office.OffcieTradeName',
            ],
            [
                'attribute' => 'IdSecurityEntity',
                'label' => Yii::t('app','Nombre'),
                'value' => 'securityEntity.Description',
            ],
            'Since',
            ['class' => 'yii\grid\ActionColumn',
             'buttons' => [
                            'view' => function ($url, $model, $key)
                                      {
                                        return '';
                                      },
                            'update' => function($url, $model, $key)
                                        {
                                            return '';
                                        }
                          ],
            ],
        ],
    ]); ?>

    <?= Html::a(Yii::t('app','Volver'),
                     ['/site/index'],
                     ['class' => 'btn btn-default']) ?>

</div>
