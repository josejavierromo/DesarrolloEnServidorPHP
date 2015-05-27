<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Companies */

$this->title = Yii::t('app', 'Paso 2 de 3: Información del centro');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app','Paso 2');

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
    		<?= Html::encode($this->title) ?>
    	</div>
    	<div class="modal-body">
		    <?= 
		    	$this->render('_form', [
		        'model' => $model,
		        'assistant' => true,
		        'readonly' => false,
		    ]) ?>	
    	</div>
    </div>
</div>