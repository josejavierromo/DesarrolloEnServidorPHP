<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Searchs\OfficesSecurityEntitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offices-security-entities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdOfficeSecurityEntity') ?>

    <?= $form->field($model, 'office.OffcieTradeName') ?>

    <?= $form->field($model, 'securityEntity.Description') ?>

    <?= $form->field($model, 'Since') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
