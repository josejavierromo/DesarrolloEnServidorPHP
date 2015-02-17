<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre_usuario')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'Telefono_usuario')->input('tel') ?>

    <?= $form->field($model, 'Email_usuario')->input('email', ['maxlength' => 63]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => 127]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
