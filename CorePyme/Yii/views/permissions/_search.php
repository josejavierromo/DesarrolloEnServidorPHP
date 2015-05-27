<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Searchs\PermissionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permissions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdPermission') ?>

    <?= $form->field($model, 'IdSecurityEntity') ?>

    <?= $form->field($model, 'IdSecurityElement') ?>

    <?= $form->field($model, 'View') ?>

    <?= $form->field($model, 'Add') ?>

    <?php // echo $form->field($model, 'Modify') ?>

    <?php // echo $form->field($model, 'Remove') ?>

    <?php // echo $form->field($model, 'Print') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
