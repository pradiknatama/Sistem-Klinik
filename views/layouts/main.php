<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $bar=[];
    $bar[]=['label' => 'Home', 'url' => ['/site/index']];
    if(Yii::$app->user->isGuest){
        $bar[] =['label' => 'Sign in', 'url' => ['/user/security/login']];
        $bar[] =['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest];
    }
    else{
        if ( array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'dokter') {
            //dokter navbar
            $bar[] = ['label' => 'Obat', 'url' => ['/obat']];
    
        }elseif (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'admin') {
            //admin navbar
            $bar[] = ['label' => 'Pegawai', 'url' => ['/user/admin/index']];
            $bar[] = ['label' => 'Role', 'url' => ['/admin']];
            $bar[] = ['label' => 'Wilayah', 'url' => ['/wilayah']];
            $bar[] = ['label' => 'Tindakan', 'url' => ['/tindakan']];
            $bar[] = ['label' => 'Obat', 'url' => ['/obat']];
        }else{
            $bar[] = ['label' => 'Obat', 'url' => ['/obat']];
            $bar[] = ['label' => 'Pasien', 'url' => ['/pasien']];
        }
        $bar[]=['label' => 'Sign out (' . Yii::$app->user->identity->username . ')','url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']];
    }
    
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => [
    //         ['label' => 'Home', 'url' => ['/site/index']],
    //         Yii::$app->user->isGuest ?
    //             ['label' => 'Sign in', 'url' => ['/user/security/login']] :
  
    //                 'linkOptions' => ['data-method' => 'post']],
    //         ['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
    //     ],
    // ]);
    
    echo Nav::widget([

        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => $bar

    ]);

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
