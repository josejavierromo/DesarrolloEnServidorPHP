<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CorePyme\Security\SecurityEntityTypes;
use app\models\CorePyme\Log\Sessions;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$session = Sessions::getSession(Yii::$app->session->getId());

$this->title = Yii::t('app','CorePyme').' - '.$session->office->OffcieTradeName;
$this->params['breadcrumbs'][] = $this->title;
?>
   <h3><?= $session->office->OffcieTradeName ?></h3>
    <div class="row">

        <div id="modConfiguration" class="panel panel-default col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="panel-heading"><span class='glyphicon glyphicon-cog'> <?= Yii::t('app','Configuración') ?></span></div>
            <div class="list-group">
                <?= Html::a(Yii::t('app','Empresas'),['/companies/index'], ['class' => 'list-group-item']) ?>
                <?= Html::a(Yii::t('app','Acceso a empresas'),['/offices-security-entities/index'], ['class' => 'list-group-item']) ?>
            </div>
        </div>

        <div id="modSeguridad" class="panel panel-default col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="panel-heading"><span class='glyphicon glyphicon-tasks'> <?= Yii::t('app','Seguridad') ?></span></div>
            <div class="list-group">
                <?= Html::a(Yii::t('app','Usuarios'),['/security-entities/index', 'type' => SecurityEntityTypes::user], ['class' => 'list-group-item']) ?>
                <?= Html::a(Yii::t('app','Grupos'),['/security-entities/index', 'type' => SecurityEntityTypes::group], ['class' => 'list-group-item']) ?>
                <?= Html::a(Yii::t('app','Roles'),['/security-entities/index', 'type' => SecurityEntityTypes::role], ['class' => 'list-group-item']) ?>
                <?= Html::a(Yii::t('app','Permisos'),['/permissions/index'], ['class' => 'list-group-item']) ?>
            </div>
        </div>

        <div id="modCustomers" class="panel panel-default col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="panel-heading"><span class='glyphicon glyphicon-user'> <?= Yii::t('app','Clientes') ?></span></div>
            <div class="panel-body"></div>
        </div>
    </div>