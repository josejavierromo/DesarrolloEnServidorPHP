<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Bienvenido";
?>

<div id="pnlDefault" class="site-login panel panel-default col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="panel-heading">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="jumbotron">
		A continuación se le solicitará la información correspondiente a la empresa o empresas que se desean gestionar
	</div>
    <?php $form = ActiveForm::begin([
        'id' => 'welcome-form',
        'options' => ['class' => 'form-signin'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label'],
        ],
    ]); ?>

	<div class="panel-footer">
        <?= Html::a('Continuar', ['/companies/assistant'] ,['class' => 'btn btn-default pull-right']) ?>
	</div>
    <?php ActiveForm::end(); ?>


</div>
