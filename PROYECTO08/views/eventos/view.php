<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Eventos */

$this->title = $model->Codigo_evento;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_evento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_evento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Codigo_evento',
            'Nombre_evento',
            'Email_evento:email',
            'Direccion_evento',
            'Telefono_evento',
            'Descripcion_evento',
            'Logo',
            'Portada',
            'Fecha_creacion',
            'Fecha_inicio',
            'Fecha_fin',
            'Numero_usuarios',
            'Cod_usuario',
        ],
    ]) ?>

</div>
