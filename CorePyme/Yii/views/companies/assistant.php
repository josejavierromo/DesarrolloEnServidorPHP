<?php

use yii\helpers\Html;
use app\models\CorePyme\Security\Searchs\OfficesSearch;
use app\models\CorePyme\Security\Companies;


/* @var $this yii\web\View */
/* @var $model app\models\CorePyme\Security\Companies */

$this->title = Yii::t('app', 'Paso 1 de 3: Información de la empresa');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app','Paso 1');

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
    		<?= Html::encode($this->title) ?>
    	</div>
    	<div class="modal-body">
		    <?php

		        $searchModelCreate = new OfficesSearch();
		        $dataProviderCreate = $searchModelCreate->search(-999);

		    	echo $this->render('_form', [
			        'model' => $model,
			        'assistant' => true,
			        'readonly' => false,
		            'searchModel' => $searchModelCreate,
		            'dataProvider' => $dataProviderCreate,
		    	]);
		    ?>
		 </div>
	</div>
</div>