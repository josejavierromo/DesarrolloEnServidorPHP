<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\CorePyme\Security\SecurityEntityTypes;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entidades de seguridad');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="securityentities-index">

    <p>
        <div class="btn-group">
            <?php echo $this->render('createModal', ['type' => $type]); 
            switch($type)
            {
                case SecurityEntityTypes::user:
                    echo Html::a(Yii::t('app','Grupos'), ['index', 'type' => SecurityEntityTypes::group], ['class' => 'btn btn-default']);
                    echo Html::a(Yii::t('app','Roles'), ['index', 'type' => SecurityEntityTypes::role], ['class' => 'btn btn-default']);
                    break;
                case SecurityEntityTypes::group:
                    echo Html::a(Yii::t('app','Usuarios'), ['index', 'type' => SecurityEntityTypes::user], ['class' => 'btn btn-default']);
                    echo Html::a(Yii::t('app','Roles'), ['index', 'type' => SecurityEntityTypes::role], ['class' => 'btn btn-default']);
                    break;
                case SecurityEntityTypes::role:
                    echo Html::a(Yii::t('app','Usuarios'), ['index', 'type' => SecurityEntityTypes::user], ['class' => 'btn btn-default']);
                    echo Html::a(Yii::t('app','Grupos'), ['index', 'type' => SecurityEntityTypes::group], ['class' => 'btn btn-default']);
                    break;
            }
            ?>
        </div>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'columns' => [
             'Name',
             'Description',
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
