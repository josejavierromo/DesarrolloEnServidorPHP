<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
    								]); ?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
		if(!$readonly)
		{
			if(isset($model->Logo) || $model->Logo !== null)
			{
				echo $form->field($model, 'Logo',
				      	     [
								'template' => '{label}<br/><img src="img/'.$model->Logo.'" class="img-thumbnail"/><br/>{input}',
								'inputOptions' => ['value' => 'img/'.$model->Logo],
							 ])->fileInput();
			}
			else
			{
				echo $form->field($model, 'Logo',
	      	     [
					'template' => '{label}<br/><img src="img/noImagen.png" class="img-thumbnail"/><br/>{input}',
					'inputOptions' => ['value' => 'img/noImagen.png'],
				 ])->fileInput();	
			}
		}	
		else
		{
			if(isset($model->Logo) || $model->Logo !== null)
			{
				echo Html::img('img/'.$model->Logo, ['class' => 'img-thumbnail']);
			}
			else
			{
				echo Html::img('img/noImagen.png', ['class' => 'img-thumbnail']);
			}
		}
	?>
	</div>

    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
	    <?= $form->field($model, 'TradeName',
	                   [
	                    'template' => '{label}{input}{error}',
	                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
	                   ])->textInput(['maxlength' => 50])->hint('') ?>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	    <?= $form->field($model, 'CIF',
	                   [
	                    'template' => '{label}{input}{error}',
	                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
	                   ])->textInput(['maxlength' => 15]) ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <?= $form->field($model, 'CorporateName',
	                   [
	                    'template' => '{label}{input}',
	                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
	                   ])->textInput(['maxlength' => 70]) ?>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <?= $form->field($model, 'Notes',
	                   [
	                    'template' => '{label}{input}',
	                    'inputOptions' => ['class' => 'form-control', 'readOnly' => $readonly],
	                   ])->textInput(['maxlength' => 255]) ?>
    </div>

    <?php

    if($assistant === false)
    {
    	if(!$readonly)
    	{
		    echo '<div class="form-group">';
		    switch($coreAction)
		    {
		    	case 'create':
				    echo Html::submitButton(Yii::t('app', 'Guardar'), [
				    													'class' => 'btn btn-success',
				    													'formAction' => 'index.php?r=companies%2Fcreate',
				    												  ]);
					break;
				case 'update':
				    echo Html::submitButton(Yii::t('app', 'Modificar'), [
				    													'class' => 'btn btn-primary',
				    													'formAction' => 'index.php?r=companies%2Fupdate&id='.$model->IdCompany,
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
		    			 ['/companies/index'],
		    			 ['class' => 'btn btn-default']);
			echo '</div>';
		}
    }
    else
    {
    	echo '<div class="form-group">';
    	echo Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-default']);
    	echo '</div>';
    }
    ?>

    <?php ActiveForm::end(); ?>

    <?php 
    if(!$assistant)
    {
	    echo GridView::widget([
	        'dataProvider' => $dataProvider,
	        //'filterModel' => $searchModel,
	        'caption' => Yii::t('app','Centros asociados').'	'.Yii::$app->view->renderFile("@app/views/offices/createModal.php", ['company' => $model]),
	        'layout' => '{items}{pager}',
	        'columns' => [
	            //'IdOffice',
	            //'IdCompany',
	            'OfficeAlias',
	            'OfficeCode',
	            'Colour',
		        ['class' => 'yii\grid\ActionColumn',
		         'buttons' =>[
		         			'view' => function($url, $model, $key)
		         			{
		         				return Yii::$app->view->renderFile("@app/views/offices/viewModal.php", ['model' => $model]);
		         			},
		         			'update' => function($url, $model, $key)
		         			{
		         				return Yii::$app->view->renderFile("@app/views/offices/updateModal.php", ['model' => $model]);
		         			}
		         ],
	             'controller' => 'offices',
	            ],
	        ],
	    ]); 
	}

    ?>

</div>
