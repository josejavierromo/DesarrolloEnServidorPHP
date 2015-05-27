<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Offices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if($assistant)
    {
        echo '<div class="form-group field-company-companyName">';
        echo Html::label(Yii::t('app','Empresa'), null, ['class' => '']);
        echo Html::input('text','Company[CorporateName]',
                          $model->getCompany() !== null ? $model->getCompany()->CorporateName : '',
                          [
                            'class' => 'form-control',
                            'readOnly' => true,
                          ]);
        echo '</div>';
    }
    ?>

    <div class="col-xs-12 col-sm-12 col-md-4">
        <?= $form->field($model, 'OfficeAlias',
                   [
                    'template' => '{label}{input}',
                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                   ])->textInput(['maxlength' => 30]) ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group field-offices-colour required">
            <label class="control-label" for="offices-colour">Color</label>
            <?php
            if(!$readonly)
            {
                echo '<input type="color" id="offices-colour" class="form-control" name="Offices[Colour]" value='.$model->Colour.'>';
            }
            else
            {
                echo '<input type="color" id="offices-colour" class="form-control" name="Offices[Colour]" value='.$model->Colour.' disabled>';   
            }
            ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?= $form->field($model, 'OfficeCode',
                   [
                    'template' => '{label}{input}{error}',
                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                   ])->textInput(['maxlength' => 10]) ?>    
    </div>
        <?= $form->field($model, 'IdCompany',
                    [
                        'template' => '{input}',
                    ])->hiddenInput() ?> 
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <?= $form->field($model, 'OfficeName',
                   [
                    'template' => '{label}{input}',
                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                   ])->textInput(['maxlength' => 60]) ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?= $form->field($model, 'CIF',
                   [
                    'template' => '{label}{input}{error}',
                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                   ])->textInput(['maxlength' => 15]) ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?= $form->field($model, 'OffcieTradeName',
                   [
                    'template' => '{label}{input}',
                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
                   ])->textInput(['maxlength' => 50]) ?>
    </div>

    <?php

    if(!$assistant)
    {
        if(!$readonly)
        {
            echo '<div class="form-group">';
            switch($coreAction)
            {
                case 'create':
                    echo Html::submitButton(Yii::t('app', 'Guardar'), [
                                                                        'class' => 'btn btn-success',
                                                                        'formAction' => 'index.php?r=offices%2Fcreate',
                                                                      ]);
                    break;
                case 'update':
                    echo Html::submitButton(Yii::t('app', 'Modificar'), [
                                                                        'class' => 'btn btn-primary',
                                                                        'formAction' => 'index.php?r=offices%2Fupdate&id='.$model->IdOffice,
                                                                      ]);
                    break;

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
                         ['/companies/index', 'id' => $model->IdCompany],
                         ['class' => 'btn btn-default']);
            echo '</div>';
        }
    }
    else
    {
        echo '<div class="form-group">';
        echo Html::a('Anterior',
                    ['/companies/assistant'],
                    ['class' => 'btn btn-default']);
        echo Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-default']);
        echo '</div>';
    }

    ?>

    <?php ActiveForm::end(); ?>
</div>
