<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Searchs\OfficesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdOffice') ?>

    <?= $form->field($model, 'IdCompany') ?>

    <?= $form->field($model, 'OfficeAlias') ?>

    <?= $form->field($model, 'OfficeName') ?>

    <?= $form->field($model, 'OffcieTradeName') ?>

    <?php // echo $form->field($model, 'CIF') ?>

    <?php // echo $form->field($model, 'OfficeCode') ?>

    <?php // echo $form->field($model, 'Colour') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
