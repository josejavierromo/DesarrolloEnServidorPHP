<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eventos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Codigo_evento',
            'Nombre_evento',
            'Email_evento:email',
            'Direccion_evento',
            'Telefono_evento',
            // 'Descripcion_evento',
            // 'Logo',
            // 'Portada',
            // 'Fecha_creacion',
            // 'Fecha_inicio',
            // 'Fecha_fin',
            // 'Numero_usuarios',
            // 'Cod_usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
