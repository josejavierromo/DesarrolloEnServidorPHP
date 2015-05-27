<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CorePyme\Security\SecurityEntityTypes;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\SecurityElements;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Permissions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permissions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdSecurityEntity')->dropDownList(ArrayHelper::map(SecurityEntities::getAllSecurityEntities(SecurityEntityTypes::user)->all(),'IdSecurityEntity','Name')) ?>

    <?= $form->field($model, 'IdSecurityElement')->dropDownList(ArrayHelper::map(SecurityElements::getAllSecurityElements()->all(),'IdSecurityElement','SecurityElement')) ?>

    <div class="form-group col-lg-12">

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'View')->checkBox() ?>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'Add')->checkBox() ?>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'Modify')->checkBox() ?>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'Remove')->checkBox() ?>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <?= $form->field($model, 'Print')->checkBox() ?>
        </div>
    </div>

    <div class="form-group">
        <?php
            switch($coreAction)
            {
                case 'create':
                    echo Html::submitButton(Yii::t('app', 'Guardar'), [
                                                                        'class' => 'btn btn-success',
                                                                        'formAction' => 'index.php?r=permissions%2Fcreate',
                                                                      ]);
                    break;
                case 'update':
                    echo Html::submitButton(Yii::t('app', 'Modificar'), [
                                                                        'class' => 'btn btn-primary',
                                                                        'formAction' => 'index.php?r=permissions%2Fupdate&id='.$model->IdPermission,
                                                                      ]);
                    break;

            }

            echo Html::resetButton(Yii::t('app', 'Cancelar'), [
                                                                'class' => 'btn btn-default',
                                                                'data-dismiss' => 'modal',
                                                              ]);
         ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
