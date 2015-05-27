<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorePyme\Security\Searchs\PermissionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Permisos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permissions-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= $this->render('createModal') ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'columns' => [
            [
                'attribute' => 'IdSecurityEntity',
                'label' => Yii::t('app','Usuario'),
                'value' => 'securityEntity.Description',
            ],
            [
                'attribute' => 'IdSecurityElement',
                'label' => Yii::t('app','Elemento seguridad'),
                'value' => 'securityElement.SecurityElement',
            ],
            'View',
            'Add',
            'Modify',
            'Remove',
            'Print',

            ['class' => 'yii\grid\ActionColumn',
             'buttons' => [
                            'view' => function($url, $model, $key)
                            {
                                return '';
                            },
                            'update' => function($url, $model, $key)
                            {
                                return $this->render('updateModal', ['model' => $model]);
                            },
                         ],
            ],
        ],
    ]); ?>

    <?= Html::a(Yii::t('app','Volver'),
                     ['/site/index'],
                     ['class' => 'btn btn-default']) ?>

</div>
