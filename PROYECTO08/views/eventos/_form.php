<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Eventos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eventos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre_evento')->textInput(['maxlength' => 63]) ?>

    <?= $form->field($model, 'Email_evento')->textInput(['maxlength' => 63]) ?>

    <?= $form->field($model, 'Direccion_evento')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'Telefono_evento')->textInput() ?>

    <?= $form->field($model, 'Descripcion_evento')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Logo')->textInput() ?>

    <?= $form->field($model, 'Portada')->textInput() ?>

    <?= $form->field($model, 'Fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'Fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'Fecha_fin')->textInput() ?>

    <?= $form->field($model, 'Numero_usuarios')->textInput() ?>

    <?= $form->field($model, 'Cod_usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
