<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CorePyme\Security\SecurityEntityTypes;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Inicio de sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pnlDefault" class="site-login panel panel-default col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="panel-heading">
        <h4><?= Html::encode($this->title) ?>
        <?php echo Yii::$app->view->renderFile('@app/views/security-entities/registerModal.php') ?></h4>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-signin'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username', [
        'options'=> ['class' => 'col-lg-12'],
        'inputOptions' => [
            'placeholder' => Yii::t('app','Usuario'),
            ],
        'inputTemplate'=> '<div class="input-group pull-left">
                                <span class="input-group-btn">
                                    <a id="clearUser" class="btn btn-default"><span class="glyphicon glyphicon-user"/></a>
                                </span>
                                {input}
                            </div>',
        ])->label(false); ?>


    <?= $form->field($model, 'password', [
        'options'=> ['class' => 'col-lg-12'],
        'inputOptions'=> [
            'placeholder'=> Yii::t('app','Contraseña'),
            ],
        'inputTemplate' => '<div class="input-group pull-left">
                                <span class="input-group-btn">
                                    <a id="clearPassword" class="btn btn-default"><span class="glyphicon glyphicon-lock"/></a>
                                </span>
                                {input}
                                <span class="input-group-btn">
                                    <a id="showPassword" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"/></a>
                                </span>
                            </div>',
        ])->passwordInput()->label(false); ?>


    <?= $form->field($model, 'rememberMe', [
        'options'=> ['class' => 'col-lg-12'],
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

    <div id="login" class="btn-group">
        <?= Html::submitButton('Entrar', 
                              ['class' => 'btn btn-default', 'name' => 'login-button', 'id' => 'login-button']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
