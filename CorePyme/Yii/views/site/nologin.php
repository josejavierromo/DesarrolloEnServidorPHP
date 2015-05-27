<?php

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app','Sin permisos de acceso');
?>

<div id="pnlDefault" class="site-login panel panel-default col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="panel-heading">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="jumbotron">
		<?= Yii::t('app','No tiene permisos para acceder a ninguna empresa registrada en el sistema, por favor pongase en contacto con el administrador del sistema.') ?>
	</div>
	<div class="panel-footer">
	    <?= Html::a(Yii::t('app','Volver'),
                 ['/site/logout'],
                 ['class' => 'btn btn-default',
                  'data-method' => 'post',
                 ]) ?>
	</div>
</div>
