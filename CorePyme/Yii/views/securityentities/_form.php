<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CorePyme\Security\SecurityEntityTypes;
use app\models\CorePyme\Security\SecurityEntities;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\SecurityEntities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="securityentities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdEntityType',
                    [
                        'template' => '{input}',
                    ])->hiddenInput(); ?>

    <?= $form->field($model, 'Name', [
            'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
    ])->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Description', [
            'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
    ])->textInput(['maxlength' => 125]) ?>

    <?php 
        if($model->IdEntityType == SecurityEntityTypes::user)
        {
            echo $form->field($model, 'Password', [
                        'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                ])->passwordInput(['maxlength' => 60]);

            echo $form->field($model, 'IdSecurityEntityRelated', [
                        'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                ])->dropDownList(ArrayHelper::map(SecurityEntities::getAllSecurityEntities(SecurityEntityTypes::group)->all(),'IdSecurityEntity','Name'),['Prompt' => Yii::t('app','Seleccionar')]);
        }
        else if($model->IdEntityType == SecurityEntityTypes::group)
        {
            echo $form->field($model, 'IdSecurityEntityRelated', [
                        'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                ])->dropDownList(ArrayHelper::map(SecurityEntities::getAllSecurityEntities(SecurityEntityTypes::role)->all(),'IdSecurityEntity','Name'),['Prompt' => Yii::t('app','Seleccionar')]);
        }
    ?>

    <?= $form->field($model, 'Notes', [
            'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
    ])->textInput(['maxlength' => 255]) ?>

    <?php 
        if($coreAction !== 'register')
        {
            
            echo $form->field($model, 'Validated', [
                        'inputOptions' => ['class' => 'form-control', $readonly ? 'disabled' : ''],
                        ])->checkBox(); 
        }
    ?>
    <?php
        if(!$readonly)
        {
            echo '<div class="form-group">';
            switch($coreAction)
            {
                case 'create':
                    echo Html::submitButton(Yii::t('app', 'Guardar'), [
                                                                        'class' => 'btn btn-success',
                                                                        'formAction' => 'index.php?r=security-entities%2Fcreate',
                                                                      ]);
                    break;
                case 'update':
                    echo Html::submitButton(Yii::t('app', 'Modificar'), [
                                                                        'class' => 'btn btn-primary',
                                                                        'formAction' => 'index.php?r=security-entities%2Fupdate&id='.$model->IdSecurityEntity,
                                                                      ]);
                    break;
                case 'register':
                    echo Html::submitButton(Yii::t('app', 'Guardar'), [
                                                        'class' => 'btn btn-success',
                                                        'formAction' => 'index.php?r=security-entities%2Fregister',
                                                      ]);

            }
            echo Html::resetButton(Yii::t('app', 'Cancelar'), [
                                                                'class' => 'btn btn-default',
                                                                'data-dismiss' => 'modal',
                                                              ]);
            echo '</div>';
        }
        else
        {
            echo '<div class="form-group">';
            echo Html::a(Yii::t('app','Volver'), 
                         ['/security-entities/index', 'type' => $model->IdEntityType],
                         ['class' => 'btn btn-default']);
            echo '</div>';
        }
    ?>

    <?php ActiveForm::end(); ?>

</div>
