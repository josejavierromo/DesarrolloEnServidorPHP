<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eventos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo_evento') ?>

    <?= $form->field($model, 'Nombre_evento') ?>

    <?= $form->field($model, 'Email_evento') ?>

    <?= $form->field($model, 'Direccion_evento') ?>

    <?= $form->field($model, 'Telefono_evento') ?>

    <?php // echo $form->field($model, 'Descripcion_evento') ?>

    <?php // echo $form->field($model, 'Logo') ?>

    <?php // echo $form->field($model, 'Portada') ?>

    <?php // echo $form->field($model, 'Fecha_creacion') ?>

    <?php // echo $form->field($model, 'Fecha_inicio') ?>

    <?php // echo $form->field($model, 'Fecha_fin') ?>

    <?php // echo $form->field($model, 'Numero_usuarios') ?>

    <?php // echo $form->field($model, 'Cod_usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
