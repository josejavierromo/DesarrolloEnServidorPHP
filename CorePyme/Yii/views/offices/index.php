<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorePyme\Security\Searchs\OfficesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Offices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Offices'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn',
             'multiple' => false],

            //'IdOffice',
            //'IdCompany',
            'OfficeAlias',
            'OfficeName',
            'OffcieTradeName',
            'CIF',
            'OfficeCode',
            'Colour',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?= Html::a(Yii::t('app','Volver'),
                     ['/site/index'],
                     ['class' => 'btn btn-default']) ?>

</div>
