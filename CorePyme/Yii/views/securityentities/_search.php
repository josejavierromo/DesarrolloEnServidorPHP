<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Searchs\SecurityEntitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="security-entities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdSecurityEntity') ?>

    <?= $form->field($model, 'IdEntityType') ?>

    <?= $form->field($model, 'IdSecurityEntityRelated') ?>

    <?= $form->field($model, 'IdUILanguage') ?>

    <?= $form->field($model, 'IdPrintLanguage') ?>

    <?php // echo $form->field($model, 'Name') ?>

    <?php // echo $form->field($model, 'Description') ?>

    <?php // echo $form->field($model, 'Password') ?>

    <?php // echo $form->field($model, 'AuthKey') ?>

    <?php // echo $form->field($model, 'AccessToken') ?>

    <?php // echo $form->field($model, 'Validated') ?>

    <?php // echo $form->field($model, 'Notes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
