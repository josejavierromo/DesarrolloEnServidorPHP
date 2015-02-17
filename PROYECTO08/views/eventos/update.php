<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eventos */

$this->title = 'Update Eventos: ' . ' ' . $model->Codigo_evento;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_evento, 'url' => ['view', 'id' => $model->Codigo_evento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eventos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
