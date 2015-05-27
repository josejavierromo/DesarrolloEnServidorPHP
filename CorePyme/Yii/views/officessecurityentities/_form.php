<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CorePyme\Security\SecurityEntityTypes;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\Offices;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\OfficesSecurityEntities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offices-security-entities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdSecurityEntity')->dropDownList(
    											ArrayHelper::map(
    														SecurityEntities::getAllSecurityEntities(SecurityEntityTypes::user)->all(),
    														'IdSecurityEntity',
    														'Description')
    												  ); ?>

    <?= $form->field($model, 'IdOffice')->dropDownList(
    									 ArrayHelper::map(
    									 			     Offices::getAllOffices()->all(), 'IdOffice', 'OffcieTradeName'
    									 				 )
    												  ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success',
                                                          'formAction' => 'index.php?r=offices-security-entities%2Fcreate']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
