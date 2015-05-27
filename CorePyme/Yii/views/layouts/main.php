<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\CorePyme\Security\SecurityEntityTypes;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php
    NavBar::begin([
        'id'=>'menu',
        'brandLabel' => '<img src="img/CorePYME 120x35.png"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top pull-left',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left pull-left'],
        'items' => [
                   ['label' => 'Configuracion',
                    'items' => [
                                   ['label' => Yii::t('app','Empresas'),
                                    'url' => ['/companies/index']],
                                   ['label' => Yii::t('app','Acceso a empresas'),
                                    'url' => ['/offices-security-entities/index']],
                               ],
                   ],
                   ['label' => 'Seguridad',
                    'items' => [
                                   ['label' => Yii::t('app','Usuarios'), 
                                    'url' => ['/security-entities/index', 'type' => SecurityEntityTypes::user]],
                                   ['label' => Yii::t('app','Grupos'),
                                    'url' => ['/security-entities/index', 'type' => SecurityEntityTypes::group]],
                                   ['label' => Yii::t('app','Roles'),
                                    'url' => ['/security-entities/index', 'type' => SecurityEntityTypes::role]],
                                   ['label' => Yii::t('app','Permisos'),
                                    'url' => ['/permissions/index']],
                                ],
                    ],
                    ['label' => 'Clientes',
                     'url' => '#'],
                ],
        ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right pull-right'],
        'items' => [
                ['label' => Yii::$app->user->identity->Description,
                 'items' => [
                            ['label' => 'Ver perfil', 
                             'url' => ['/security-entities/index', 'type' => SecurityEntityTypes::user], 
                             'linkOptions' => ['data-method' => 'post']],
                            '<li class="divider"></li>',
                            ['label' => 'Cerrar sesión', 
                             'url' => ['/site/logout'], 
                             'linkOptions' => ['data-method' => 'post']],
                        ],
                ],
        ],
    ]);
    echo "<div id='shadowHeader'/>";
    NavBar::end();
?>

<?php $this->beginBody() ?>
    <div class="wrap">
        <div class="container">
            <?= $content ?>
        </div>
    </div>
    <footer class="footer">
        <div id="shadowFooter"/>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
